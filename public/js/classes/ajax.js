// This class is responsible for sending get and post ajax requests

class Ajax{
    static send(type, url, formData, success_call_back) {
        $.ajax({
            url: url,
            type: type,
            dataType: 'JSON',
            data: formData,
            processData: false,
            contentType: false,
            success: success_call_back,
            error: (errors) => {
                // get validation errors
                let index = 0;
                $.each( errors.responseJSON.errors, (key, error) => {
                    if( index == 0 )
                        this.showMessage(error[0], 0);
                        
                    index++;
                });

                // for other errors
                if( index == 0 )
                    this.showMessage( errors.responseJSON.message, 0);
            }
        });
    }
    // showMessage function displaying just the first error message
    // type would be 1 in case success or 0 in case error
    static showMessage(message, type){
        $("#global-message").text(message);
        if(type === 1)
            $("#global-message").addClass('alert success');
        else
            $("#global-message").addClass('alert error');

        setTimeout(() => {
            $("#global-message").text('');
            $("#global-message").removeClass('alert success error');
        }, 3000);
    }
}