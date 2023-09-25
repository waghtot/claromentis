document.getElementById('documents').onclick=function(e){
    if(e.target.nodeName=='BUTTON'){
        if(e.target.dataset['process']){
            sendFileToProcess(e.target.dataset['process']);
        }else{
            deleteFile(e.target.dataset['delete']);
        }
    }
}

function sendFileToProcess(filename){
    Swal.fire({
        title: 'Process this file?',
        text: 'Do you want to process this file: ' + filename + ' again?',
        icon: 'question',
        showCancelButton: true,
    }).then((result)=>{
        if(result.isConfirmed){
            data = {
                action: 'process',
                method: 'POST',
                filename: filename,
                url: '/process'
            }
            sendFile(data);
        }
    });
}

function deleteFile(filename){
    Swal.fire({
        title: 'WARNINIG!!!',
        text: 'Do you really want delete this file: ' + filename + '?',
        icon: 'warning',
        showCancelButton: true,
    }).then((result)=>{
        if(result.isConfirmed){
            data = {
                action: 'delete',
                method: 'POST',
                filename: filename,
                url: '/delete'
            }
            sendFile(data);
        }
    });
}