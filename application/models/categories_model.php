<?php

require_once(APP_DIR.'models/category_model.php');

class Categories_model extends Model {

    private $categoriesQuery = "SELECT 
                                    s.id, s.path, COUNT(pc.category_id)
                                FROM
                                    (SELECT 
                                        d.descendant_category_id AS id,
                                            GROUP_CONCAT(n.category_name
                                                ORDER BY n.id
                                                SEPARATOR ' -> ') AS path
                                    FROM
                                        blog_categories_path d
                                    JOIN blog_categories_path a ON (a.descendant_category_id = d.descendant_category_id)
                                    JOIN blog_category n ON (n.id = a.ancestor_category_id)
                                    JOIN blog_category nc ON (nc.id = d.descendant_category_id)
                                    WHERE
                                        d.ancestor_category_id = 0
                                            AND d.ancestor_category_id <> d.descendant_category_id
                                            AND nc.category_name like '%{{cat_name}}%'
                                    GROUP BY d.descendant_category_id) s
                                        LEFT JOIN
                                    blog_posts_categories pc ON (s.id = pc.category_id)
                                GROUP BY s.id;";

    private $categoriesDetailsQuery = "SELECT 
                                            s.id, s.path, category_description, category_name, COUNT(pc.category_id) as category_count
                                        FROM
                                            (SELECT 
                                                nc.category_description, nc.category_name, 
                                                d.descendant_category_id AS id,
                                                    GROUP_CONCAT(n.category_name
                                                        ORDER BY n.id
                                                        SEPARATOR ' -> ') AS path
                                            FROM
                                                blog_categories_path d
                                            JOIN blog_categories_path a ON (a.descendant_category_id = d.descendant_category_id)
                                            JOIN blog_category n ON (n.id = a.ancestor_category_id)
                                            JOIN blog_category nc ON (nc.id = d.descendant_category_id)
                                            WHERE
                                                d.ancestor_category_id = 0
                                                    AND d.ancestor_category_id <> d.descendant_category_id
                                                    AND nc.category_name like '%{{cat_name}}%'
                                            GROUP BY d.descendant_category_id) s
                                                LEFT JOIN
                                            blog_posts_categories pc ON (s.id = pc.category_id)
                                        GROUP BY s.id;";

    private $findCategoryByNameQuery = "SELECT COUNT(*) AS count FROM blog_category WHERE category_name = '{{cat_name}}'";

    private $addNewCategoryQuery = "INSERT INTO blog_category (category_name, category_enabled, category_created_by, category_description) 
                                        VALUES ('{{cat_name}}', true, 1, '{{cat_desc}}');";
                                    
    private $addCategoryToPath = "INSERT INTO blog_categories_path (ancestor_category_id, descendant_category_id, path_depth) VALUES
                                        (0, (SELECT id FROM blog_category WHERE category_name = '{{cat_name}}'), 1),
                                        ((SELECT id FROM blog_category WHERE category_name = '{{cat_name}}'), (SELECT id FROM blog_category WHERE category_name = '{{cat_name}}'), 0); ";


    public function getSomething($id)
    {
        $id = (int)$this->escapeString($id);
        $query = sprintf("SELECT * FROM `blog_post` WHERE `id` = %d", $id);
        $result = $this->query($query);
        return $result;
    }

    public function getCategoriesOption($id = null, $option=0, $ret = 1)
    {
        $categoriesOptions = '';

        $categoriesQuery = str_replace('{{cat_name}}', '', $this->categoriesQuery);
        $categoriesResult = $this->query($categoriesQuery);
        if($option==1) {
            $categoriesOptions .= "<option value=0>pusta</option>";
        } elseif ($option==2) {
            $categoriesOptions .= "<option value=0>(brak)</option>";
        } elseif ($option==3) {
            $categoriesOptions .= "<option value=0>wszystkie</option>";
        }

        if($categoriesResult)
        {
            foreach ($categoriesResult as $categoryInfo)
            {
                $categoriesOptions .= "<option value='$categoryInfo->id'>".preg_replace("^ &mdash; (.*)^", "$1", preg_replace("([A-z0-9_/ ]*->)", " &mdash; ", $categoryInfo->path))."</option>";
//                $categoriesOptions .= "<option value='$categoryInfo->id'>".preg_replace("([A-z0-9_/ ]*->)", " &mdash; ", $categoryInfo->path)."</option>";
            }
        }

        return $categoriesOptions;
    }

    public function getCategories($catName = '')
    {
        $categoriesRows = '';
        $categoriesQuery = str_replace('{{cat_name}}', $catName, $this->categoriesDetailsQuery);
        $categoriesResult = $this->query($categoriesQuery);

        if($categoriesResult)
        {
            foreach ($categoriesResult as $categoryData)
            {
                $categoriesRows .= "<tr><td><input type='checkbox' name='category_delete[]' value='$categoryData->id'></td>";
                $categoriesRows .= "<td>$categoryData->category_name</td>";
                $categoriesRows .= "<td>$categoryData->category_description</td>";
                $categoriesRows .= "<td>$categoryData->category_count</td></tr>";
            }
        }

        return $categoriesRows;
    }

    public function add_category($name, $description, $parent = 0) {
        $categoryExistsQuery = str_replace('{{cat_name}}', $name, $this->findCategoryByNameQuery);
        $categoryExistsResult = $this->query($categoryExistsQuery);

        $categoryByNameCount = $categoryExistsResult[0]->count;

        if($categoryByNameCount >= 1) {
            return false;
        } else {
            $insertCategoryQuery = str_replace('{{cat_name}}', $name, $this->addNewCategoryQuery);
            $insertCategoryQuery = str_replace('{{cat_desc}}', $description,  $insertCategoryQuery);

            $addPath = str_replace('{{cat_name}}', $name, $this->addCategoryToPath); 


            $this->execute('START TRANSACTION;');
            $categoryInsertResult = $this->execute($insertCategoryQuery);
            $addPathResult = $this->execute($addPath);

            $wasSuccessful = ($categoryInsertResult && $addPathResult);
            if($wasSuccessful) {
                $this->execute('COMMIT;');
            } else {
                $this->execute('ROLLBACK;');
            }

            return ($wasSuccessful ? wasSuccessful : "Nie udało się") ;
        }
    }

}

?>