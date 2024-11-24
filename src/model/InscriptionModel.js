const db = require('../config/database');

const InscriptionModel = {
    inscription: (mail, nom_inscrit, nom_manifestation, callback) => {
        db.query('CALL Inscription(?, ?, ?)', [mail, nom_inscrit, nom_manifestation], callback);
    }
};

module.exports = InscriptionModel;
