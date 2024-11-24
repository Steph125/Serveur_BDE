// ideaRoutes.js
const express = require('express');
const router = express.Router();
const ideaController = require('../controllers/IdeaController');
const multer = require('multer');


router.get('/', ideaController.getAllIdeas);
router.post('/add-idea', multer, ideaController.addIdea);
router.put('/:id', ideaController.updateIdea);
router.delete('/:id', ideaController.deleteIdea);
router.post('/add-date', ideaController.addIdeaDate);

module.exports = router;
