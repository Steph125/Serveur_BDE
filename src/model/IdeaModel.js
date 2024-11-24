const db = require('../config/database');

const IdeaModel = {
    getAllIdeas: (callback) => {
        db.query('SELECT * FROM idees', callback);
    },
    addIdea: (mail_i, nom_i, description_i, image_i, callback) => {
        db.query('INSERT INTO idees (mail_i, nom_i, description_i, image_i) VALUES (?, ?, ?, ?)', [mail_i, nom_i, description_i, image_i], callback);
    },
    updateIdea: (id, description, image, callback) => {
        db.query('UPDATE idees SET description = ?, image = ? WHERE id = ?', [description, image, id], callback);
    },
    deleteIdea: (id, callback) => {
        db.query('DELETE FROM idees WHERE id = ?', id, callback);
    },
    addIdeaDate: (nom_i, new_date, callback) => {
        db.query('CALL AjoutDate(?, ?)', [nom_i, new_date], callback);
    },

    getIdeaOwnerEmail: (nom_i, callback) => {
        db.query('SELECT mail_i FROM idees WHERE nom_i = ?', nom_i, (error, results) => {
            if (error) {
                callback(error, null);
                return;
            }
            if (results.length > 0) {
                callback(null, results[0].mail_i);
            } else {
                callback('Idea owner email not found', null);
            }
        });
    }
};

module.exports = IdeaModel;
