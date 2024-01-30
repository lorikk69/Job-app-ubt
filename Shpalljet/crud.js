function redirectForma(jobId) {
    window.location.href = '../Forma/Forma.php?job_id=' + jobId;
}

function editJob(jobId) {
    console.log('Edit job with ID:', jobId);
}


function deleteJob(jobId) {
    if (confirm('Are you sure you want to delete this job?')) {
        console.log('Deleting job with ID:', jobId);

        fetch('../api/deleteJob.php?job_id=' + jobId, {
            method: 'DELETE',
        })
        .then(response => response.json())
        .then(data => {
            console.log('Delete response:', data);

            if (data.success) {
                window.location.reload();
            } else {
                alert('Failed to delete job. Please try again.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
}

