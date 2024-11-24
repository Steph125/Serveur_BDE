// eventRoutes.js
const express = require('express');
const router = express.Router();
const eventController = require('../controllers/EventController');

const multer = require('../middlewares/multer_config')

router.get('/', eventController.getAllEvents);
router.get('/:id', eventController.getEventById);
router.post('/', multer, eventController.addEvent);
router.put('/:id', eventController.updateEvent);
router.delete('/:id', eventController.deleteEvent);

module.exports = router;
