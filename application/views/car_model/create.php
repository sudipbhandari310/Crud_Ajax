<form action="" method="post" id="createCarModel" name="createCarModel">
    <div class="modal-body">

        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" id="name" value="" class="form-control">
            <p class="nameError  text-danger"></p>
        </div>


        <div class="form-group">
            <label> Color</label>
            <input type="text" name="color" id="color" value="" class="form-control" placeholder="color">
            <p class="colorError  text-danger"></p>
        </div>


        <div class="form-group">
            <label>Transmission</label>
            <select id="transmission" name="transmission" class="form-control">
                <option>Automatic</option>
                <option>Manual</option>
            </select>
        </div>




        <div class="form-group">
            <label> Price</label>
            <input type="price" name="price" id="price" value="" class="form-control" placeholder="price">
            <p class="priceError  text-danger"></p>
        </div>







        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
        </div>

</form>