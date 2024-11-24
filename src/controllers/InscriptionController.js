const InscriptionModel = require('../model/InscriptionModel');

const inscriptionController = {
    inscription: (req, res) => {
        const { mail, nom_inscrit, nom_manifestation } = req.body;
        InscriptionModel.inscription(mail, nom_inscrit, nom_manifestation, (error, result) => {
            if (error) {
                console.error('Erreur lors de l\'inscription à la manifestation :', error);
                res.status(500).send('Erreur interne du serveur');
                return;
            }
            res.json({ message: 'Inscription réussie' });
        });
    }
};

module.exports = inscriptionController;
