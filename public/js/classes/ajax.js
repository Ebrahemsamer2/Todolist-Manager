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
            success: success_call_back
        });
    }    
}