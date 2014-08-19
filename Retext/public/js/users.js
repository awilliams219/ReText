/**
 * User Management Specific Functions
 */

function validateNewUser()
{
    var errors = '';
    
    if ( $('#usernameField').val().length < 6 )
    {
        errors += "Username must be at least 6 characters.\n";
    }
    
    if ( $('#passwordField').val().length < 6 )
    {
        errors += "Password field must be at least 6 characters.\n";
    }
    
    if ( $('#passwordField').val() !== $('#passwordConfirmField').val() )
    {
        errors += "Password and Confirmation fields must match.\n";
    }
    
    if (! (
            ( $('#canAddBox').prop('checked') ) ||
            ( $('#canDeleteBox').prop('checked') ) ||
            ( $('#adminBox').prop('checked') ) 
          )
       )
    {
        errors += "You must select at least one user right.\n";
    }
    
    if (errors) 
    {
        alert("You have some errors.  Please correct them before submitting:\n\n" + errors);
        return false;
    }
    else 
    {
        $('#addForm').submit();
    }
        
}