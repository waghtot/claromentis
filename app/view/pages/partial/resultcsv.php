<!-- display result for chosen file or last displayed -->
<div class="col-md-4 offset-md-4">

<?php 
echo '<h4>Result for file:<br>'.$data[0].'</h4>'; 
array_pop($data);

?>
<p>

    <table class="table table-striped">
        <thead>
        <tr class="table-active">
            <th scope="col">Category</th>
            <th scope="col" class="move-right">Amount</th>
        </tr>
        </thead>
        <tbody>
    <?php

    foreach (Controller::readFile($data[0]) as $file){
        echo '<tr>';
        echo '<td>'.$file[0].'</td>';
        echo '<td class="move-right">'.$file[1].'</td>';
        echo '</tr>';
    }

    ?>
    </tbody>
    </table>
</p>
<p class="move-right">
    <button type="button" class="btn btn-success btn-sm" onclick="location.href='<?php echo DISPLAY.$data[0]; ?>'">Download report as CSV</button>
</p>

</div>