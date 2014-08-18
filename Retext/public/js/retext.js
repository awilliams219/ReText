/**
 * Page Load Event Hooks
 */
$(function() {
    pageLoadEvents();
});


/**
 * Page Load Events
 * 
 * Fired once on page load
 */
function pageLoadEvents()
{
    highlightTaskEntry();
}


/**
 * Highlights the sidebar entry for the current task
 */
function highlightTaskEntry()
{
    if ($(location).attr('pathname').indexOf('keyword') > -1)
    {
        $('#KeywordTaskEntry').children().addClass('TaskSelected');
    }
    else if ($(location).attr('pathname').indexOf('users') > -1)
    {
        $('#UserTaskEntry').children().addClass('TaskSelected');
    }
}


/**
 * Enables Delete X on Keyword TR on Keyword Management Page
 */
function enableX(id)
{
    $('#DeleteX_' + id).removeClass('Hidden');
}

/**
 * Disables Delete X on Keyword TR on Keyword Management Page
 */
function disableX(id)
{
    $('#DeleteX_' + id).addClass('Hidden');
}

/**
 * Confirms Deletion of URL Redirect before submission.
 */
function confirmDelete(id, keyword)
{
    $('#deleteID').val(id);
    $('#deleteText').text(keyword);
    $('#deleteModal').modal('show');
    
}

