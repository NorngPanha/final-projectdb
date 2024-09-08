// document.addEventListener('DOMContentLoaded', () => {
//     const menuToggle = document.querySelector('.menu-toggle');
//     const navLinks = document.querySelector('.nav-links');

//     menuToggle.addEventListener('click', () => {
//         navLinks.classList.toggle('active');
//     });
// });

// document.getElementById('contactForm').addEventListener('submit', function(event) {
//     event.preventDefault();

//     const formData = new FormData(this);
//     const data = {
//         name: formData.get('name'),
//         email: formData.get('email'),
//         message: formData.get('message')
//     };

//     fetch('/submit', {
//         method: 'POST',
//         headers: {
//             'Content-Type': 'application/json'
//         },
//         body: JSON.stringify(data)
//     })
//     .then(response => response.json())
//     .then(result => {
//         document.getElementById('responseMessage').innerText = 'Form submitted successfully!';
//         document.getElementById('contactForm').reset();
//     })
//     .catch(error => {
//         console.error('Error:', error);
//         document.getElementById('responseMessage').innerText = 'There was an error submitting the form.';
//     });
// });