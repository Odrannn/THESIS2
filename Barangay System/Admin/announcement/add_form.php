<div class="modal-content">
    <form action="post_announcement.php" method="post">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Announcement</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style = "height: 50%;overflow-y: auto;">
            <div class="container">
                <div class="row">
                    <div class="col-md pt-2">
                        <div class="form-floating">
                            <input class="form-control" type="text" id="title" name="title">
                            <label for="title">Title</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md pt-2">
                        <label for="img">Image</label>
                        <input class="form-control" type="file" id="img" name="ann_image">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md pt-2">
                        <div class="form-floating">
                            <textarea class="form-control" name="description" id="description" cols="30" rows="10"></textarea>
                            <label for="description">Description</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            <input type="submit" class="btn btn-success" name="post" value="Post">
        </div>
    </form>
</div>

    