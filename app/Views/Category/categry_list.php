<?php echo view('Common/header.php'); ?>
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="content-page">
            <div class="content">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-body">
                            <div class="row-6">
                            <h4  class="card-title">List <a href="<?=('index');?>" class="btn  btn-primary" style="float: right; margin-top: -5px; ">Add Form</a></h4>
                            <hr>
                                <div class="row">
                                    <div class="col-xl-12 col-lg-12">
                                        <div class="card-box">
                                            <table id="table-categery" class="table table-bordered table-hover table-striped nowrap  dt-responsive w-100"
                                                 >
                                                <thead>
                                                    <tr>
                                                        <th>S.No</th>
                                                        <th>Username </th>
                                                        <th>Email </th>
                                                        <th>Contact </th>
                                                        <th>Qualification </th>
                                                        <th>State </th>
                                                        <th>City </th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>

<script>

        
    $(function() {
        var table_news = $('#table-categery').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                url: "show_list_catgery",
                type: "GET"
            },
            "columnDefs": [{
                "targets": [0],
                "orderable": false,
            },

        ],
        });
        $("#table-categery tbody").on('click', 'button', function() {
            var id = $(this).attr('data-id');
            if (this.name == "deleteButton") {
                var is_delete = confirm("Are your sure?");
                if (is_delete) {
                    // $.post('delete', {
                    //     id: id
                    // }, function(result) {
                    //     $(".result").html(result);
                    //     table_news.ajax.reload();
                    // });

                    $.ajax({
                        url : "delete",
                        type: "POST",
                        data : {id:id},
                        success: function(data, textStatus, jqXHR)
                        {
                            table_news.ajax.reload();

                            //data - response from server
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                        }
                    });
                }
            }
        });
    });
    </script>
</div>

