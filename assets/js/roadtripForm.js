/**
 * Affiche un message de test dans la console pour vérifier si le script est bien chargé
 */
console.log('test');

/**
 * Sélection des différentes étapes du formulaire.
 * @const {HTMLElement} step1 - L'élément représentant la première étape du formulaire.
 * @const {HTMLElement} step2 - L'élément représentant la deuxième étape du formulaire.
 * @const {HTMLElement} step3 - L'élément représentant la troisième étape du formulaire.
 */
const step1 = document.getElementById('step1');
const step2 = document.getElementById('step2');
const step3 = document.getElementById('step3');

/**
 * Sélection des boutons "Suivant" pour les étapes.
 * @const {HTMLElement} next - Le bouton pour passer de l'étape 1 à l'étape 2.
 * @const {HTMLElement} next2 - Le bouton pour passer de l'étape 2 à l'étape 3.
 */
const next = document.getElementById('step1-next');
const next2 = document.getElementById('step2-next');

/**
 * Ajoute un écouteur d'événements pour le bouton "Suivant" de la première étape.
 * Lorsque l'utilisateur clique, l'étape 1 est cachée et l'étape 2 est affichée.
 */
if (next) {
    next.addEventListener("click", function(e) {
        e.preventDefault();
        console.log('Passage à l\'étape 2'); // Ajout d'un log pour le débogage
        step1.classList.add('hidden');
        step2.classList.remove('hidden');
    });
}

/**
 * Ajoute un écouteur d'événements pour le bouton "Suivant" de la deuxième étape.
 * Lorsque l'utilisateur clique, l'étape 2 est cachée et l'étape 3 est affichée.
 */
if (next2) {
    next2.addEventListener("click", function(e) {
        e.preventDefault();
        console.log('Passage à l\'étape 3'); // Ajout d'un log pour le débogage
        step2.classList.add('hidden');
        step3.classList.remove('hidden');
    });
}
