// notificationRoutes.js
const express = require('express');
const router = express.Router();
const notificationController = require('../controllers/NotificationController');

router.get('/', notificationController.getAllNotifications);
router.post('/', notificationController.createNotification);
router.delete('/:id', notificationController.deleteNotification);

module.exports = router;
