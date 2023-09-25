<form action="" method="post" id="editCarModel" name="editCarModel">
    <input type="hidden" id="name" value="<?php echo $row['id'] ?>" name="id">
    <div class="modal-body modal-lg">
        <div>
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" id="name" value="<?php echo $row['name'] ?>" class="form-control"
                    placeholder="Name">
                <p class="nameError text-danger"></p>
            </div>


            <div class="form-group">
                <label> color</label>
                <input type="text" name="color" id="color" value="<?php echo $row['color'] ?>" class="form-control"
                    placeholder="color">
                <p class="priceError  text-danger"></p>
            </div>



            <div class="form-group">
                <label>Transmission</label>
                <select id="transmission" name="transmission" class="form-control">
                    <option value="Automatic" <?php echo ($row['transmission'] == "Automatic")? 'selected':'' ?>>
                        Automatic</option>
                    <option value="Manual" <?php echo ($row['transmission'] == "Manual")? 'selected':'' ?>>Manual
                    </option>
                </select>

            </div>

            <div class="form-group">
                <label> Price</label>
                <input type="price" name="price" id="price" value="<?php echo $row['name'] ?>" class="form-control"
                    placeholder="price">
                <p class="priceError  text-danger"></p>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
    </div>