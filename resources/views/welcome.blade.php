<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel FileUpload</title>
        <!-- Bootstrap CSS --> 
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    </head>
    <body>
        <div class="container" style="margin-top: 20px">
            <h1>JQuery Ajax - File Upload</h1>
            <hr/>
            <!-- File Form -->
            <div class="row">
                <div class="col-md-12">
                <form id="myform">
                    <input type="file" name="myphoto" id="myphoto" />
                    <br/><br/>
                    <input type="hidden" name="_token"  value="{{csrf_token()}}" />
                    <div id="myphoto-placeholder"></div>
                    <button id="upload" class="btn btn-primary" type="button">Upload</button>
                </form>
                </div>
            </div>
            
        </div>
        <!-- jQuery -->
        <script src="//code.jquery.com/jquery.js"></script>
        <!-- BiggoJS -->
        <script src="https://rawgit.com/Biggo6/biggojs/master/biggo.js"></script>
        <!-- Custom Code -->
        <script>

        // Function that collects form data file input
        function formDataCollector(photoId, formId) {
            var isFileUpload = false;
            var data;
            if(Biggo.isFileValueSetted(myphoto) != undefined){
                var arr  = Biggo.serializeData(myform);
                var arr2 = ["myphoto"];
                isFileUpload = true;
                data = Biggo.prepareFormData(arr, arr2);
            }else{
                data = Biggo.serializeData(myphoto);
            }
            return [isFileUpload, data];
        }

        function upload(onUpload) {
            if(onUpload) {
                $('#upload').text('Uploading...').removeClass('btn-primary').addClass('btn-danger');
            }else {
                $('#upload').text('Upload').removeClass('btn-danger').addClass('btn-primary');
            }
        }

        $(function() {
            // Use BiggoJs
            Biggo.changePhotoDiv('myphoto', 'myphoto-placeholder', 250, 250, ''); // 
            $('body').on('click', '#upload', function() {

                upload(true);
                
                // Destructure - ES6 
                [isFileUpload, data] = formDataCollector(myphoto, myform);

                // Server URL
                var url = '{{url("file/upload")}}'; // Laravel Route POST

                // Send data to server
                Biggo.talkToServer(url, data, isFileUpload).then(function(res){
                    upload(false);
                    if(!res.error) {
                        Biggo.showFeedBack(myform, 'Successfully Uploaded!', false);
                    }
                });
            });
        });
        </script>
    </body>
</html>
