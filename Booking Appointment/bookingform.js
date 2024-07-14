document.addEventListener('DOMContentLoaded', function() {
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('appointmentDate').setAttribute('min', today);
});



document.addEventListener('DOMContentLoaded', function() {
    const bookingForm = document.getElementById('bookingForm');

    bookingForm.addEventListener('submit', function(event) {
        // Prevent form submission
        event.preventDefault();

        // Perform client-side validation
        if (validateForm()) {
            // Submit the form
            bookingForm.submit();
        }
    });

    function validateForm() {
        const childName = document.getElementById('childName').value;
        const dob = document.getElementById('dob').value;
        const parentName = document.getElementById('parentName').value;
        const contactNumber = document.getElementById('contactNumber').value;
        const appointmentDate = document.getElementById('appointmentDate').value;
        const appointmentTime = document.getElementById('appointmentTime').value;
        const medicalService = document.getElementById('medicalService').value;
        const doctorInCharge = document.getElementById('doctorInCharge').value;

        if (childName === '' || dob === '' || parentName === '' || contactNumber === '' || appointmentDate === '' || appointmentTime === '' || medicalService === '' || doctorInCharge === '') {
            alert('Please fill out all required fields.');
            return false;
        }

        return true;
    }
});
