// notificationModel.js
const db = require('../config/database');

const NotificationModel = {
    getAllNotifications: (callback) => {
        db.query('SELECT * FROM notifications', callback);
    },
    createNotification: (userId, message, callback) => {
        db.query('INSERT INTO notifications (user_id, message) VALUES (?, ?)', [userId, message], callback);
    },
    deleteNotification: (id, callback) => {
        db.query('DELETE FROM notifications WHERE id = ?', id, callback);
    }
};

module.exports = NotificationModel;
