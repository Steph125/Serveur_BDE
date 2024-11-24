// Dans le fichier helper.js

exports.success = (message, data) => {
    return { message, data };
};

exports.getUniqueId = (boutique) => {
    const boutiqueIds = boutique.map(product => product.id);
    const maxId = boutiqueIds.reduce((a, b) => Math.max(a, b)); // Changement ici: utiliser boutiqueIds plutôt que pokemonsIds
    const uniqueId = maxId + 1;
    return uniqueId;
};
