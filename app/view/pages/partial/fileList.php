<div class="col">

    <?php echo end($data); 
    array_pop($data);
    ?>
    <p>

        <table class="table table-striped">
            <thead>
            <tr class="table-active">
                <th scope="col">File Name</th>
                <th scope="col" class="move-right">Action</th>
            </tr>
            </thead>
            <tbody>
        <?php

        foreach ($data as $file){
            echo '<tr>';
            echo '<td class="filename">'.$file.'</td>';
            echo '<td class="move-right"><button type="button" class="btn btn-success btn-sm" data-process="'.$file.'">Process</button> <button type="button" class="btn btn-danger btn-sm" data-delete="'.$file.'">Delete</button></td>';
            echo '</tr>';
        }

        ?>
        </tbody>
        </table>
    </p>
</div>
<script src="app/view/js/fileAction.js?v=<?php echo date('Hmi');?>"></script>

