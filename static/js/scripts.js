
function build_pagination()
{
    var posts_per_page = 10;
    var posts_count = $("#posts_list > article").length;
    var pages = Math.ceil(posts_count / posts_per_page);

    $('#current_page').val(0);
    $('#posts_per_page').val(posts_per_page);


    var pagination = "<ul class='pagination'>";
    for (var i = 0; i < pages; i++)
    {
        pagination += "<li><a class='page_link' longdesc=" + i + " href='javascript:set_posts_page(" + i + ");'>" + (i+1) + "</a></li>";
    }
    pagination += "</ul>";
    $("#pagination").html(pagination);

    $('.pagination li:first').addClass('active');

    $('#posts_list').children().css('display', 'none');

    $('#posts_list').children().slice(0, posts_per_page).css('display', 'block');
}

function set_posts_page(page)
{
    var posts_per_page = parseInt($('#posts_per_page').val());

    var start_post = page * posts_per_page;

    var end_post = start_post + posts_per_page;

    $('#posts_list').children().css('display', 'none').slice(start_post, end_post).css('display', 'block');

    $('.page_link[longdesc=' + page + ']').parent().addClass('active').siblings('.active').removeClass('active');

    $('#current_page').val(page);
}
