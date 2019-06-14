//when the webpage has loaded do this
$(document).ready(function() {
    //if the value within the dropdown box has changed then run this code
    $('#num_pages').change(function(){
        //get the number of fields required from the dropdown box
        var num = $('#num_pages').val();

        var i = 0; //integer variable for 'for' loop
        var html = ''; //string variable for html code for fields
        //loop through to add the number of fields specified
        for (i = 1; i<=num; i++) {
            //concatinate number of fields to a variable
            html += '<div class="form-group row"><label for="num_pages-'+ i +'" class="col-sm-2 col-form-label">URL - '+ i +':</label>';
            html += '<div class="col-sm-6">';
            html += '<input type="text" class="form-control" name="url-'+ i +'" id="url-'+ i +'" placeholder="# of Page to evaluate">';
            html += '</div>';
            html += '</div>';
        }

        //insert this html code into the div with id catList
        $('#URLList').html(html);
    });
});
