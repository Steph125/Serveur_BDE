// notificationController.js
const NotificationModel = require('../model/NotificationModel');

const notificationController = {
    getAllNotifications: (req, res) => {
        NotificationModel.getAllNotifications((error, results) => {
            if (error) {
                console.error('Error fetching notifications:', error);
                res.status(500).send('Internal Server Error');
                return;
            }
            res.json(results);
        });
    },
    createNotification: (req, res) => {
        const { userId, message } = req.body;
        NotificationModel.createNotification(userId, message, (error, result) => {
            if (error) {
                console.error('Error creating notification:', error);
                res.status(500).send('Internal Server Error');
                return;
            }
            res.json({ id: result.insertId, userId, message });
        });
    },
    deleteNotification: (req, res) => {
        const id = req.params.id;
        NotificationModel.deleteNotification(id, (error, result) => {
            if (error) {
                console.error('Error deleting notification:', error);
                res.status(500).send('Internal Server Error');
                return;
            }
            res.json({ message: 'Notification deleted successfully' });
        });
    }
};

module.exports = notificationController;
