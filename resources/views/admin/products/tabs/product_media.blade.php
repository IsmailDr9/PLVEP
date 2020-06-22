@push('js')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.1/min/dropzone.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.1/min/dropzone.min.css">
    <script type="text/javascript">
        Dropzone.autoDiscover = false;
        $(document).ready(function () {
            $('#dropzone_file_upload').dropzone({
                url: '{{route('product.image',$product->id)}}',
                paramName:'file',
                uploadMultiple:false,
                maxFiles:15,
                maxFilessize:3, // MB
                acceptedFiles:'image/*',
                // dictDefaultMessage:'سيبيبي سبيسب سيسي',
                params: {
                    _token: '{{ csrf_token() }}'
                },
                addRemoveLinks:true,
                removedfile:function(file)
                {
                    $.ajax({
                        dataType: 'json',
                        type: 'post',
                        url: '{{route('image.delete')}}',
                        data: {_token: '{{csrf_token()}}',id:file.fid}
                    });
                    var fmock;
                    return (fmock = file.previewElement) != null ? fmock.parentNode.removeChild(file.previewElement):void 0;
                },
                init:function () {
                    @foreach($product->files()->get() as $image)
                        var mock = {name:'{{$image->name}}',fid: "{{$image->id}}",size:'{{$image->size}}',type:'{{$image->mime_type}}'};
                        this.emit('addedfile',mock);
                        this.options.thumbnail.call(this,mock,'{{url('storage/'.$image->full_file)}}');
                    @endforeach

                    this.on('sending', function (file,xhr,formData) {
                        formData.append('fid','');
                        file.fid = '';
                    });

                    this.on('success', function (file,response) {
                        file.fid = response.id;
                    });
                }
            });
        });
    </script>
@endpush

<div class="dropzone" id="dropzone_file_upload"></div>