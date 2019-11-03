$(document).ready(() => {

  $('#loginModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var recipient = button.data('whatever') // Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this)
    modal.find('.modal-title').text('New message to ' + recipient)
    modal.find('.modal-body input').val(recipient)
  })

  $('table td').keyup(function() {
      clearTimeout($.data(this, 'timer'));
      dataString = {
          "name":"text",
          "value": $(this)[0]['innerText'],
          "nameCondition":"task_id",
          "valueCondition": $(this)[0]['parentNode']['cells'][0]['innerText'],
          "edittask":"yes"
      };
      var wait = setTimeout(saveData(dataString), 500);
      $(this).data('timer', wait);
  });

  $("input[type='checkbox']").change(function() {
      $value = $(this)[0]['checked'] ? 1 : 0;
      dataString = {
          "name":"done",
          "value": $value,
          "nameCondition":"task_id",
          "valueCondition": $(this)[0]['parentNode']['parentNode']['parentNode']['cells'][0]['innerText'],
          "edittask":"yes"
      };
      saveData(dataString);
  });
  /*
  $('tr').dblclick(function(){
      console.log($(this));
      $('#tableTr').modal('show');
      console.log('1');
  });
  */

});

function saveData (dataString) {
  $.ajax({
          type:'POST',
          data:dataString,
          url:'index',
          success:function(data) {
              console.log(data);
          }
  });
}

/*
  отображение выборки сообщений постранично
  (страница, количество сообщений на странице)
*/
function viewMessages(rank, activeCount)
{

    if (activeCount === -1) {
        let chapter = document.querySelector('.active');
        activeCount = parseInt(chapter.id.substring(10));
        if (activeCount > 1) {
            activeCount = activeCount-1;
        }
    }
    if (activeCount === -2) {
        let chapter = document.querySelector('.active');
        activeCount = parseInt(chapter.id.substring(10))+1;
    }

    if (activeCount === 1 || activeCount === 0) {
        document.getElementById('pagination-prev').className = 'page-item disabled';
    } else {
        document.getElementById('pagination-prev').className = 'page-item';
    }

    if (rank === 1) {
        document.getElementById('pagination-prev').className = 'page-item disabled';
        document.getElementById('pagination-follow').className = 'page-item disabled';
    } else {
        document.getElementById('pagination-prev').className = 'page-item';
        document.getElementById('pagination-follow').className = 'page-item';
    }

    if (activeCount === rank) {
        document.getElementById('pagination-follow').className = 'page-item disabled';
    } else {
       document.getElementById('pagination-follow').className = 'page-item';
    }

    for (let i=1; i<=rank; i++) {
        for (let j=1; j<=3; j++) {
            if (i !== activeCount) {
                document.getElementById('visability'+(j+(i*3-3))).className = 'displayNone';
                document.getElementById('visability'+(j+(i*3-3))).className = 'displayNone';
                document.getElementById('visability'+(j+(i*3-3))).className = 'displayNone';
                document.getElementById('pagination'+i).className = 'page-item';
            } else {
                document.getElementById('visability'+(j+(i*3-3))).className = '';
                document.getElementById('visability'+(j+(i*3-3))).className = '';
                document.getElementById('visability'+(j+(i*3-3))).className = '';
                document.getElementById('pagination'+i).className = 'page-item active';
            }
        }
    }

}
