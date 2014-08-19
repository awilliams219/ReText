/**
 * Keyword Specific Functions
 */

function validateNewKeyword()
{
    var errors = "";
    
    if ( $('#keywordField').val().length < 3 )
    {
        errors += "Keyword must be at least 3 characters long.\n";
    }
    
    if ( $('#urlField').val().length < 1 )                                           /* Note:  We are intentionally not checking the validity of the url  */
    {                                                                               /*        to allow for text-based responses.  Though not an official */
        errors += "URL Field cannot be blank.\n";                                   /*        requirement of the app, it allows for a little more        */
    }                                                                               /*        flexibility.                                               */

    if (errors)
    {
        alert ("You have some errors.  Please correct them before submitting:\n\n" + errors);
    }
    else
    {
        $('#addForm').submit();
    }
    
}
    

