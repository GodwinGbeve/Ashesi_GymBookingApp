document.addEventListener('DOMContentLoaded', function () {
    const stars = document.querySelectorAll('.star-rating .star');
    let selectedRating = 0;
  
    function highlightStars(rating) {
      stars.forEach(function (star, index) {
        if (index < rating) {
          star.classList.add('active');
        } else {
          star.classList.remove('active');
        }
      });
    }
  
    stars.forEach(function (star, index) {
      star.addEventListener('mouseover', function () {
        highlightStars(index + 1);
      });
  
      star.addEventListener('mouseout', function () {
        highlightStars(selectedRating);
      });
  
      star.addEventListener('click', function () {
        selectedRating = index + 1;
      });
    });
  
    const cancelButton = document.getElementById('cancel-button');
    const submitButton = document.getElementById('submit-button');
    const commentsInput = document.getElementById('comments');
    const feedbackTypeSelect = document.getElementById('feedback-type');
  
    cancelButton.addEventListener('click', function () {
      commentsInput.value = '';
      feedbackTypeSelect.selectedIndex = 0;
      selectedRating = 0;
      highlightStars(0);
    });
  
    submitButton.addEventListener('click', function () {
      const feedback = {
        comments: commentsInput.value,
        feedbackType: feedbackTypeSelect.value,
        scalingRating: selectedRating
      };
  
      console.log(feedback); // Replace with your desired logic for submitting the feedback
    });
  });

  