const IdeaModel = require('../model/IdeaModel');

const ideaController = {
    getAllIdeas: (req, res) => {
        IdeaModel.getAllIdeas((error, results) => {
            if (error) {
                console.error('Erreur lors de la récupération des idées :', error);
                res.status(500).send('Erreur interne du serveur');
                return;
            }
            res.json(results);
        });
    },
    addIdea: (req, res) => {
        const { mail_i, nom_i, description_i, image_i } = req.body;
        IdeaModel.addIdea(mail_i, nom_i, description_i, image_i, (error, result) => {
            if (error) {
                console.error('Erreur lors de l\'ajout de l\'idée :', error);
                res.status(500).send('Erreur interne du serveur');
                return;
            }
            res.json({ id: result.insertId, mail_i, nom_i, description_i, image_i });
        });
    },
    updateIdea: (req, res) => {
        const id = req.params.id;
        const { description, image } = req.body;
        IdeaModel.updateIdea(id, description, image, (error, result) => {
            if (error) {
                console.error('Erreur lors de la mise à jour de l\'idée :', error);
                res.status(500).send('Erreur interne du serveur');
                return;
            }
            res.json({ id, description, image });
        });
    },
    deleteIdea: (req, res) => {
        const id = req.params.id;
        IdeaModel.deleteIdea(id, (error, result) => {
            if (error) {
                console.error('Erreur lors de la suppression de l\'idée :', error);
                res.status(500).send('Erreur interne du serveur');
                return;
            }
            res.json({ message: 'Idée supprimée avec succès' });
        });
    },
    addIdeaDate: (req, res) => {
        const { nom_i, new_date } = req.body;
        IdeaModel.addIdeaDate(nom_i, new_date, (error, result) => {
            if (error) {
                console.error('Erreur lors de l\'ajout de la date à l\'idée :', error);
                res.status(500).send('Erreur interne du serveur');
                return;
            }
            // Envoi de la réponse au client
            res.json({ message: 'Date ajoutée à l\'idée avec succès' });

            // Envoi de l'e-mail de notification
            IdeaModel.getIdeaOwnerEmail(nom_i, (err, email) => {
                if (err) {
                    console.error('Erreur lors de la récupération de l\'e-mail du propriétaire de l\'idée :', err);
                    return;
                }
                sendNotificationEmail(email, new_date);
            });
        });
    }
};

function sendNotificationEmail(email, newDate) {
    // Code pour envoyer l'e-mail de notification
}

module.exports = ideaController;
