<h1>CSV Uploader</h1>
<p>upload file</p>
<div class="row align-items-start">
<p>
<form method="post" enctype="multipart/form-data">
  <div class="input-group">
  <input type="file" class="form-control" name="fileupload" id="fileUpload" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
  </div>
</form>
</div>
</p>

<?php
  !empty($data->result) ? View::partial('resultcsv', $data->result) : '';
?>
<div class="row align-items-start" id="documents">

  <?php 
  //generate view for each file status
    !empty($data->data['queue']) ? View::partial('fileList', $data->data['queue']) : '';
    !empty($data->data['failed']) ? View::partial('fileList', $data->data['failed']) : '';
    !empty($data->data['processed']) ? View::partial('fileList', $data->data['processed']) : '';
  ?>

</div>

<script src="./app/view/js/fileUpload.js?v=<?php echo date('Hmi');?>" ></script>