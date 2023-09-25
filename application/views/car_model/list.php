<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ajax Crud</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo base_url().'assets/css/style.css'?>">
</head>

<body>

    <div class="header">
        <div class="container">
            <h3 class="heading">Ajax Crud Application</h3>
        </div>

    </div>
    <div class="container">
        <div class="row pt-4">
            <div class="col-md-6">

                <h5>Car Models</h5>
            </div>
            <div class="col-md-6 text-end">
                <a href="javascript:void(0)" onclick="showModal();" class="btn btn-primary">Create</a>
            </div>
            <div class="col-md-10 pt-3">

                <table class="table table-striped" id="carModelList">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Color</th>
                        <th>Transmission</th>
                        <th>Price</th>
                        <th>Created_at</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>

                    <?php if(!empty ($rows)){?>
                    <?php foreach ($rows as $row){
                        $data['row']=$row; 
                        $this->load->view('car_row.php',$data);
                    } ?>


                    <?php  } else {?>
                    <tr>
                        <td>Records not found </td>
                    </tr>
                    <?php   } ?>


                </table>
            </div>
        </div>
    </div>

    </div>





    <!-- Modal for create and update -->
    <div class="modal fade" id="createCar" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title">Create</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="response">
                </div>
            </div>
        </div>
    </div>






    <!-- Modal for delete -->

    <div class="modal fade" id="deleteModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirmation </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" onclick="deleteNow();">Yes</button>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="ajax" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">alert </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>












    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">

    </script>
    <script src="https://code.jquery.com/jquery-3.6.4.js"
        integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>

    <script>
    function showModal() {
        $("#createCar").modal("show");
        $("#createCar #title").html('Create');


        $.ajax({
            url: '<?php echo base_url().'CarModel/showCreateForm'?>',
            type: 'POST',
            data: {},
            dataType: 'json',
            success: function(response) {
                console.log(response);
                $("#response").html(response["html"]);
            }


        })
    }


    $("body").on("submit", "#createCarModel", function(e) {
        e.preventDefault();

        $.ajax({
            url: '<?php echo base_url().'CarModel/saveModel'?>',
            type: 'POST',
            data: $(this).serialize(Array),
            dataType: 'json',
            success: function(response) {


                if (response['status'] == 0) {
                    if (response["name"] != "") {
                        $(".nameError").html(response["name"]).addClass('invalid_feedback');
                        $("#name").addClass('is-invalid');
                    } else {
                        $(".nameError").html("").removeClass('invalid_feedback');
                        $("#name").removeClass('is-invalid');
                    }

                    if (response["color"] != "") {
                        $(".colorError").html(response["color"]);
                        $("#color").addClass('is-invalid');
                    } else {
                        $(".colorError").html("").removeClass('invalid_feedback');
                        $("#color").removeClass('is-invalid');
                    }


                    if (response["price"] != "") {
                        $(".priceError").html(response["price"]);
                        $("#price").addClass('is-invalid');
                    } else {
                        $(".priceError").html("").removeClass('invalid_feedback');
                        $("#price").removeClass('is-invalid');
                    }

                } else {

                    $("#createCar").modal("hide");
                    $("#ajax .modal-body").html(response['message']);
                    $("#ajax").modal("show");





                    $(".nameError").html("").removeClass('invalid_feedback');
                    $("#name").removeClass('is-invalid');

                    $(".colorError").html("").removeClass('invalid_feedback');
                    $("#color").removeClass('is-invalid');

                    $(".priceError").html("").removeClass('invalid_feedback');
                    $("#price").removeClass('is-invalid');

                    $("#carModelList").append(response["row"]);

                }
            }


        })

    })

    function showEditForm(id) {



        $("#createCar .modal-title").html('Edit');

        $.ajax({
            url: '<?php echo base_url().'CarModel/getCarModel/'?>' + id,
            type: 'POST',
            dataType: 'json',
            success: function(response) {
                console.log(response);
                $("#createCar #response").html(response["html"]);
                $("#createCar").modal('show');

            }


        });
    }

    //editCarModel


    $("body").on("submit", "#editCarModel", function(e) {
        e.preventDefault();

        $.ajax({
            url: '<?php echo base_url().'CarModel/updateModal'?>',
            type: 'POST',
            data: $(this).serialize(Array),
            dataType: 'json',
            success: function(response) {


                if (response['status'] == 0) {
                    if (response["name"] != "") {
                        $(".nameError").html(response["name"]).addClass('invalid_feedback');
                        $("#name").addClass('is-invalid');
                    } else {
                        $(".nameError").html("").removeClass('invalid_feedback');
                        $("#name").removeClass('is-invalid');
                    }

                    if (response["color"] != "") {
                        $(".colorError").html(response["color"]);
                        $("#color").addClass('is-invalid');
                    } else {
                        $(".colorError").html("").removeClass('invalid_feedback');
                        $("#color").removeClass('is-invalid');
                    }


                    if (response["price"] != "") {
                        $(".priceError").html(response["price"]);
                        $("#price").addClass('is-invalid');
                    } else {
                        $(".priceError").html("").removeClass('invalid_feedback');
                        $("#price").removeClass('is-invalid');
                    }

                } else {

                    $("#createCar").modal("hide");
                    $("#ajax .modal-body").html(response['message']);
                    $("#ajax").modal("show");





                    $(".nameError").html("").removeClass('invalid_feedback');
                    $("#name").removeClass('is-invalid');

                    $(".colorError").html("").removeClass('invalid_feedback');
                    $("#color").removeClass('is-invalid');

                    $(".priceError").html("").removeClass('invalid_feedback');
                    $("#price").removeClass('is-invalid');



                }
            }






        })

    })

    function confirmDeleteModel(id) {
        $("#deleteModal").modal("show");
        $("#deleteModal .modal-body").html("Are you sure  you want to delete # " + id);
        $("#deleteModal").data("id", id);
    }
















    function deleteNow() {
        var id = $("#deleteModal").data('id');


        $.ajax({
            url: '<?php echo base_url().'CarModel/deleteModel/'?>' + id,
            type: 'POST',
            data: {},
            dataType: 'json',
            success: function(response) {
                if (response['status'] == 1) {
                    $("#deleteModal").modal("hide");
                    $("#deleteModal.modal-body").html(response['msg']);
                    $("#deleteModal").modal("show");

                } else {
                    $("#deleteModal").modal("hide");
                    $("#deleteModal.modal-body").html(response["msg"]);
                    $("#deleteModal").modal("show");


                }
            }


        });


    }
    </script>

</html>