SELECT * FROM blog_categories_path;

SELECT 
    GROUP_CONCAT(c.category_name
        ORDER BY c.id
        SEPARATOR '->')
FROM
    blog_categories_path a
        JOIN
    blog_categories_path d ON a.descendant_category_id = d.descendant_category_id
        JOIN
    blog_category c ON c.id = a.descendant_category_id
WHERE
    a.ancestor_category_id = 1 
GROUP BY d.descendant_category_id;


select *,group_concat(n.category_name order by n.id separator ' -> ') as path
from blog_categories_path d
join blog_categories_path a on (a.descendant_category_id = d.descendant_category_id)
join blog_category n on (n.id = a.ancestor_category_id)
where d.ancestor_category_id = 1
group by d.descendant_category_id;


UPDATE blog_categories_path p
        INNER JOIN
    (SELECT 
        p.*, depths.depth - asc_depths.depth AS depth
    FROM
        blog_categories_path p
    JOIN (SELECT 
        p.descendant_category_id AS id, COUNT(*) AS depth
    FROM
        blog_categories_path p
    GROUP BY p.descendant_category_id) AS depths ON p.descendant_category_id = depths.id
    JOIN (SELECT 
        p.descendant_category_id AS id, COUNT(*) AS depth
    FROM
        blog_categories_path p
    GROUP BY p.descendant_category_id) AS asc_depths ON p.ancestor_category_id = asc_depths.id) category_depths ON p.ancestor_category_id = category_depths.ancestor_category_id
        AND p.descendant_category_id = category_depths.descendant_category_id 
SET 
    p.path_depth = category_depths.depth;
    
SELECT c.*, t.path_depth
FROM blog_category AS c
JOIN blog_categories_path AS t ON c.id = t.descendant_category_id
WHERE t.ancestor_category_id = 4;


SELECT * FROM blog_categories_path AS c
LEFT OUTER JOIN blog_categories_path AS anc
ON anc.descendant_category_id = c.descendant_category_id AND anc.ancestor_category_id <> c.ancestor_category_id
WHERE anc.ancestor_category_id IS NULL;