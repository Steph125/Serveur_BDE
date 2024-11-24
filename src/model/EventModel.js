const db = require('../config/database');

const EventModel = {
    getAllEvents: (callback) => {
        db.query('SELECT * FROM events', callback);
    },
    getEventById: (id, callback) => {
        db.query('SELECT * FROM events WHERE id = ?', id, (error, results) => {
            if (error) {
                callback(error, null);
                return;
            }
            callback(null, results[0]);
        });
    },
    addEvent: (nom_e, description_e, date_e, image_e,  callback) => {
        db.query('INSERT INTO evenements (nom_e, prix_e, description_e, date_e, image_e) VALUES (?, ?, ?, ?, ?)', [nom_e, prix_e, description_e, date_e, image_e], callback);
    },
    updateEvent: (id, name, description, image, date, callback) => {
        db.query('UPDATE events SET name = ?, description = ?, image = ?, date = ? WHERE id = ?', [name, description, image, date, id], callback);
    },
    deleteEvent: (id, callback) => {
        db.query('DELETE FROM events WHERE id = ?', id, callback);
    }
};

module.exports = EventModel;
