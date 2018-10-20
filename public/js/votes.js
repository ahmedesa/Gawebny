  $(document).ready(function () {
      /*==========================================
      =            votes for question            =
      ==========================================*/

      $(document).on('click', '.upvote_q', function (element) {
          var $this = $(this);
          element.preventDefault();

          $.ajax({
              type: "POST",
              url: urlUpvoteQ,
              data: {
                  question_id: question_id,
                  _token: token,
              },
              success: function (votes) {
                  $('#QVotesCount').html(votes);
                  if ($this.hasClass('isVoted')) {
                      $this.removeClass('isVoted');
                  } else {
                      $this.addClass("isVoted");
                  }
                  if ($('.downvote_q').hasClass('isVoted')) {
                      $('.downvote_q').removeClass('isVoted');
                  }
              }
          });

      });

      $(document).on('click', '.downvote_q', function (element) {
          var $this = $(this);
          element.preventDefault();
          $.ajax({
              type: "POST",
              url: urlDownvoteQ,
              data: {
                  question_id: question_id,
                  _token: token,
              },
              success: function (votes) {
                  $('#QVotesCount').html(votes);

                  if ($this.hasClass('isVoted')) {
                      $this.removeClass('isVoted');
                  } else {
                      $this.addClass("isVoted");
                  }
                  if ($('.upvote_q').hasClass('isVoted')) {
                      $('.upvote_q').removeClass('isVoted');
                  }
              }
          });

      });
      /*=====  End of votes for question  ======*/

      /*==========================================
      =            votes for answer             =
      ==========================================*/

      $(document).on('click', '.upvote_ans', function (element) {
          var $this = $(this);
          element.preventDefault();
          var answer_id = $this.attr('data-aid');
          $.ajax({
              type: "POST",
              url: urlUpvoteAns,
              data: {
                  answer_id: answer_id,
                  _token: token,
              },
              success: function (votes) {
                  $('#AnsVotesCount').html(votes);
                  if ($this.hasClass('isVoted')) {
                      $this.removeClass('isVoted');
                  } else {
                      $this.addClass("isVoted");
                  }
                  if ($('.downvote_ans').hasClass('isVoted')) {
                      $('.downvote_ans').removeClass('isVoted');
                  }
              }
          });

      });

      $(document).on('click', '.downvote_ans', function (element) {
          var $this = $(this);
          element.preventDefault();
          var answer_id = $this.attr('data-aid');
          $.ajax({
              type: "POST",
              url: urlDownvoteAns,
              data: {
                  answer_id: answer_id,
                  _token: token,
              },
              success: function (votes) {
                  $('#AnsVotesCount').html(votes);

                  if ($this.hasClass('isVoted')) {
                      $this.removeClass('isVoted');
                  } else {
                      $this.addClass("isVoted");
                  }
                  if ($('.upvote_ans').hasClass('isVoted')) {
                      $('.upvote_ans').removeClass('isVoted');
                  }
              }
          });

      });
      /*=====  End of votes for answer  ======*/



  });