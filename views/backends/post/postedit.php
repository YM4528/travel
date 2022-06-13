<div class="col-md-9">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Posts</a></li>
      <li class="breadcrumb-item active" aria-current="page">Edit Post</li>
    </ol>
  </nav>

  <div class="col-md-6 offset-3 mt-5 bg-dark form-container">

    <?php if (isset($_SESSION['expire'])) {

      $diff = time() - $_SESSION['expire'];
      if ($diff > 2) {
        unset($_SESSION['status']);
        unset($_SESSION['expire']);
      }
    } ?>

    <?php if (isset($_SESSION['status'])) {
    ?>

      <div class="alert alert-success alert-dismissible fade show" role="alert">

        <?php echo $_SESSION['status'] ?>

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

    <?php } ?>

    <h2 class="mt-5"> <i class="fa-solid fa-plus"></i> Edit Post</h2>
    <form class="mt-5" action="../../controllers/PostController.php" method="POST" enctype="multipart/form-data">

      <div class="form-group">
        <div class="row">
          <label for="title" class="col-md-4">Title : </label>
          <input type="text" name="title" class="form-control col-md-8" id="title" value="<?php echo $post['title'] ?>">
          <?php
          if (isset($_SESSION['title'])) { ?>
            <p class="text-danger offset-4">
              <?php echo $_SESSION['title']; ?>
            </p>
          <?php
          }
          ?>
        </div>
      </div>

      <div class="form-group">
        <div class="row">
          <label for="description" class="col-md-4">Description : </label>
          <textarea name="description" id="description" rows="10" class="col-md-8">
          <?php echo $post['description'] ?>
          </textarea>
          <?php
          if (isset($_SESSION['des'])) { ?>
            <p class="text-danger offset-4">
              <?php echo $_SESSION['des']; ?>
            </p>
          <?php
          }
          ?>
        </div>
      </div>

      <div class="form-group">
        <div class="row">
          <label for="title" class="col-md-4">Image : </label>
          <div class="custom-file col-md-8">
    <input type="file" class="custom-file-input"  name="image" id="inputGroupFile01">
    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
  </div>
         <?php
          if (isset($_SESSION['image'])) { ?>
            <p class="text-danger offset-4">
              <?php echo $_SESSION['image']; ?>
            </p>
          <?php
          }
          ?>
        </div>
      </div>


    
      <input type ="hidden" name="action" value="update">
      <input type ="hidden" name="id" value="<?php echo $post['id'] ?>">
      <div class="form-btn text-center">
        <button type="submit" class="btn btn-outline-success"><i class="fa-solid fa-circle-plus"></i> Update</button>
        <button type="reset" class="btn btn-outline-danger"><i class="fa-solid fa-eraser"></i> Reset</button>
      </div>
    </form>

  </div>