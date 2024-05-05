<?= $this->extend('backend/layout/base') ?>
<?= $this->section('content')?>

<div class="page-header">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="title">
                <h4>Insecticide Management</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="<?= base_url(route_to('admin.home'))?>" class="home-link">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Insecticide
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-3 col-md-5 mb-4">
        <div class="card card-box">
            <div class="card-header">
                <div class="clearfix">
                    <div class="text-left">
                        Add Insecticide
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form id="insecticide_form">
                    <input type="hidden" name="insecticide_ID" id="insecticide_ID">
                    <div class="row">
                        <div class="col-md-5 justify-content-center align-content-center">
                            <div class="profile-photo pt-20 w-100">
                                <a href="javascript:;" class="edit-avatar"><i class="fa fa-pencil"></i></a>
                                <input type="file" name="ins_photo" id="ins_photo" class="d-none">
                                <input type="hidden" name="inse_photo" id="inse_photo" value="insecticide_default.png">
                                <img src="<?= base_url('public/images/insecticides/insecticide_default.png') ?>" alt="" class="insecticide_photo"  style="border-radius: 100%;">
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label>Insecticide</label>
                                        <input type="text" name="insecticide" class="form-control" placeholder ="Insecticide" id="insecticide">
                                        <span class="text-danger error-text insecticide_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label>Price (₱)</label>
                                        <div class="input-group m-0 p-0">
                                            <div class="input-group-prepend" >
                                                <span class="input-group-text" style="border: 1px solid lightgray;" >₱</span>
                                            </div>
                                            <input type="number" class="form-control" name="price" id="price" value=0 step="any"> 
                                        </div>
                                        
                                        <span class="text-danger error-text price_error"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" name="descp" id="descp"></textarea>
                                <span class="text-danger error-text descp_error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="button" class="btn btn-danger cancel-fn px-4 py-2 mt-2" id="btnCancel">Cancel</button>
                        <button type="submit" class="btn btn-primary submit-fn px-4 py-2 mt-2" id="btnAdd">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-9 col-md-7 mb-4">
        <div class="card card-box">
            <div class="card-header">
                <div class="clearfix">
                    <div class="pull-left">
                        Insecticide
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-borderless table-hover table-stripe">
                        <thead>
                            <tr>
                                <th class="text-left" scope="col">#</th>
                                <th class="text-left" scope="col" style="max-width: 30px;">Insecticide</th>
                                <th class="text-left" scope="col">Picture</th>
                                <th class="text-left" scope="col">Description</th>
                                <th class="text-left" scope="col">Price</th>
                                <th class="text-left" scope="col">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>

<script>


    $('.table').DataTable({
        scrollCollapse: true,
        autoWidth: false,
        responsive: true,
        columnDefs: [{
            targets: "datatable-nosort",
            orderable: false,
        }],
        "ajax": {
            "url": "get-insecticides", // Replace with the actual path to your server-side script
            "type": "POST",
            "dataSrc": ""
        },
        "columns": [{
            "data": null,
                "render": function(data, type, row, meta) {
                    return meta.row + 1;
                }
            },
            {
                "data": "Insecticide"
                // "render": function(data, type, row) {
                //     // Set the maximum length for description
                //     var maxLength = 20; // Change this to your desired maximum length
                //     if (data.length > maxLength) {
                //         return data.substr(0, maxLength) + '...';
                //     } else {
                //         return data;
                //     }
                // }
            },
            {
                "data": "Picture",
                "render": function(data, type, row) {
                    // Set the maximum length for description
                    return '<img src="' + '<?= base_url('public/images/insecticides/') ?>' + data + '" alt="Insecticide Image" style="max-width: 50px; max-height: 50px;">';
                }
            },
            {
                "data": "Description",
                "render": function(data, type, row) {
                    // Set the maximum length for description
                    var maxLength = 50; // Change this to your desired maximum length
                    if (data.length > maxLength) {
                        return data.substr(0, maxLength) + '...';
                    } else {
                        return data;
                    }
                }
            },
            {
                "data": {"Current_Price" : "CPrice",
                         "Previous_Price" : "PPrice",
                         "ICurrent_Price" : "FCPrice"},
                "render": function(data, type, row) {
                    if(data['Previous_Price'] == null || data['Current_Price'] == data['Previous_Price']) {
                        return data['ICurrent_Price'];
                    } else if(data['Current_Price'] > data['Previous_Price']) {
                        return '<i class="icon-copy fa fa-long-arrow-up text-danger"></i> '+ data['ICurrent_Price'];
                    } else {
                        return '<i class="icon-copy fa fa-long-arrow-down text-success"></i> '+ data['ICurrent_Price'];
                    }
                }
            },
            {
                "data": "Insecticide_ID",
                "render": function(data, type, row) {
                    return '<div class="dropdown"> <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" data-color="#1b3133" href="#" role="button" data-toggle="dropdown"> <i class="dw dw-more"></i> </a> <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list"> <button class="dropdown-item editInsecticideBtn" data-id="' +
                        data +
                        '"><i class="dw dw-edit2"></i> Edit</button> <button class="dropdown-item delInsecticideBtn" data-id="' +
                        data + '"><i class="dw dw-delete-3"></i> Delete</button> </div> </div>';
                }
            }
        ],
        rowCallback: function(row, data, index) {
            $(row).find("td").addClass('text-left');
        }
    });

    $('.edit-avatar').on('click', function(e){
        e.preventDefault();
        $ins_photo = $('#ins_photo').click();
    });

    $('#ins_photo').ijaboCropTool({
        preview : '.insecticide-photo',
        setRatio:1,
        allowedExtensions: ['jpg', 'jpeg','png'],
        buttonsText:['Crop','Cancel'],
        buttonsColor:['#30bf7d','#ee5155', -15], // corrected array
        processUrl: '<?= base_url(route_to('set-insecticide-photo')) ?>',
        onSuccess:function(message, element, status) {
            if(status == 1){
                $('#inse_photo').val(message);
                var imageUrl = "<?= base_url('public/images/insecticides/')?>" + message;
                $('.insecticide_photo').attr('src', imageUrl);
            } else {
                swal("Error", "Unsuccessful", "error");
            }
        },onError:function(message, element, status){
            swal("Error", message, "error");
          }
    });

    $(document).ready(function() {
        // Hide the Cancel button initially
        $('#btnCancel').hide();

        // Add click event listener to the button that shows the Cancel button
        $('.editInsecticideBtn').on('click', function() {
            // Show the Cancel button
            $('#btnCancel').show();
        });

        // Add click event listener to the Cancel button
        $('#btnCancel').on('click', function() {
            // Handle the click event here
            // For demonstration, let's just log a message to the console
            
            $('#insecticide_form')[0].reset();
            $('#insecticide_ID').val('');
            $('.insecticide_photo').attr('src', '<?= base_url("public/images/insecticides/insecticide_default.png")?>');
            $("#inse_photo").val('insecticide_default.png')
            $('#btnAdd').text('Add');
            $('#btnCancel').hide();
        });

        $('#price').on('input', function() {
        var price = $('#price').val();
        if(price < 0){
            $('#price').val('0')
        }
    });
    });

    function clearErrorOnInputChange(elementID, errorClass) {
        $(elementID).on("input", function() {
            var opt = $(this).val();
        
            if (opt.trim() !== '') {
                $('#insecticide_form').find(errorClass).text('');
            } 
        });
    }

    clearErrorOnInputChange("#insecticide", 'span.insecticide_error');
    clearErrorOnInputChange("#price", 'span.price_error');
    clearErrorOnInputChange("#descp", 'span.descp_error');

    $(document).on('click', '.editInsecticideBtn', function(e) {
        e.preventDefault();
        var insecticideID = $(this).data("id");
        console.log(insecticideID);
        $.ajax({
            url: 'get-insecticide',
            type: 'POST',
            dataType: 'json',
            data: { 
                ID: insecticideID,
                where: 'Insecticide_ID'
            },
            success: function(resp) {
                var resp = resp[0];
                console.log(resp);
                $('#insecticide_ID').val(resp.Insecticide_ID);
                $('#insecticide').val(resp.Insecticide);
                $('#price').val(resp.Current_Price);
                $('#descp').val(resp.Description);
                
                var imageUrl = "<?= base_url('public/images/insecticides/')?>" + resp.Picture;
                
                $('.insecticide_photo').attr('src', imageUrl);
                $('#inse_photo').val(resp.Picture);
                $('#btnAdd').text('Update');
                $('#btnCancel').show();
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });

    $('#insecticide_form').on('submit', function(e) {
        e.preventDefault();
        var form = this;
        var formData = new FormData(form);

        var insecticide = $("#insecticide").val();
        var price = $("#price").val();
        var description = $("#descp").val();
        var ins_ID;
        var photo = $("#inse_photo").val();

        if($('#insecticide_ID').val() == '') {
            ins_ID = null;
        } else {
            ins_ID = $('#insecticide_ID').val();
        }

        formData.append('inse', insecticide);
        formData.append('pric', price);
        formData.append('desc', description);
        formData.append('ins_ID', ins_ID);
        formData.append('photo', photo);

        $.ajax({
            url: 'modify-insecticide',
            type: 'POST',
            dataType: 'json',
            data: formData,
            processData: false,
            dataType: 'json',
            contentType: false,
            beforeSend:function(){
                $(form).find('span.error-text').text('');
            },
            success: function(resp) {
                if ($.isEmptyObject(resp.error)) {
                    if($('#btnAdd').text() == "Add") {
                        swal("Added", "Insecticide successfully added!", "success")
                    } else {
                        swal("Updated", "Insecticide successfully updated!", "success")
                    }
                    $('#insecticide_form')[0].reset();
                    $('#insecticide_ID').val('');
                    $('.insecticide_photo').attr('src', '<?= base_url("public/images/insecticides/insecticide_default.png")?>');
                    $("#inse_photo").val('insecticide_default.png')
                    $('#btnAdd').text('Add');
                    $('#btnCancel').hide();
                    $('.table').DataTable().ajax.reload();
                } else {
                    $.each(resp.error, function(prefix, val){
                        $('span.'+prefix+'_error').text(val);
                    })
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });

    $(document).on('click', '.delInsecticideBtn', function(e) {
        e.preventDefault();
        var ID = $(this).data("id");
        swal({
                title: "Are you sure?",
                text: "You will not be able to recover this record!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            },
            function() {
                $.ajax({
                    url: 'delete-insecticide',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        ID: ID
                    },
                    success: function(resp) {
                        if (resp.success) {
                            $('#insecticide_form')[0].reset();
                            $('.table').DataTable().ajax.reload();
                            swal("Deleted!", "Record has been deleted.", "success");
                        } else {
                            swal("Failed!", "Failed to delete" + resp.ID + "!", "error");
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
    });
</script>

<?= $this->endSection() ?>