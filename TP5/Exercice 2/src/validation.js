function validateForm() {
    let password = document.forms.passwordForm.password.value;
    let confirmPassword = document.forms.passwordForm.confirmPassword.value;

    // Vérification de la correspondance des mots de passe
    if (password !== confirmPassword) {
        alert("Les mots de passe ne correspondent pas.");
        return false;
    }

    // Vérification de la longueur du mot de passe
    if (password.length < 8) {
        alert("Le mot de passe doit faire au moins 8 caractères.");
        return false;
    }

    // Vérification de la présence d'un chiffre
    if (!hasNumber(password)) {
        alert("Le mot de passe doit inclure au moins un chiffre.");
        return false;
    }

    // Vérification de la présence d'une majuscule et d'une minuscule
    if (!hasUpperCase(password) || !hasLowerCase(password)) {
        alert("Le mot de passe doit inclure au moins une lettre majuscule et une lettre minuscule.");
        return false;
    }

    if(hasNumber(password) || hasUpperCase){
        return true;
    }

    // Si toutes les vérifications sont passées
    return true;
}

// Fonctions de vérification (supposées être déjà fournies)
function hasNumber(str) {
    return /\d/.test(str);
}

function hasUpperCase(str) {
    return /[A-Z]/.test(str);
}

function hasLowerCase(str) {
    return /[a-z]/.test(str);
}
