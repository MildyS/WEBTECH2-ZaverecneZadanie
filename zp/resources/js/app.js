import './bootstrap';

$(document).ready(function () {
    $('.data-table').DataTable( {
        "order": [[ 1, "asc" ]]
    });
});
