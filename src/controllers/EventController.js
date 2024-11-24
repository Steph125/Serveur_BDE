const EventModel = require('../model/EventModel');

const eventController = {
    getAllEvents: (req, res) => {
        EventModel.getAllEvents((error, results) => {
            if (error) {
                console.error('Error fetching events:', error);
                res.status(500).send('Internal Server Error');
                return;
            }
            res.json(results);
        });
    },
    getEventById: (req, res) => {
        const id = req.params.id;
        EventModel.getEventById(id, (error, result) => {
            if (error) {
                console.error('Error fetching event:', error);
                res.status(500).send('Internal Server Error');
                return;
            }
            if (!result) {
                res.status(404).send('Event not found');
                return;
            }
            res.json(result);
        });
    },
    addEvent: (req, res) => {
        const { nom_e, prix_e, description_e, date_e, image_e } = req.body;
        const image = req.file.filename; // Obtenez le nom du fichier téléchargé depuis req.file
        EventModel.createEvent(nom_e, prix_e, description_e, image_e, date_e, (error, result) => {
            if (error) {
                console.error('Error adding event:', error);
                res.status(500).send('Internal Server Error');
                return;
            }
            res.json({ message: 'L\'événement a été ajouté avec succès.' });
        });
    },
    updateEvent: (req, res) => {
        const id = req.params.id;
        const { name, description, date } = req.body;
        const image = req.file.filename; // Obtenez le nom du fichier téléchargé depuis req.file
        EventModel.updateEvent(id, name, description, image, date, (error, result) => {
            if (error) {
                console.error('Error updating event:', error);
                res.status(500).send('Internal Server Error');
                return;
            }
            res.json({ id, name, description, image, date });
        });
    },
    deleteEvent: (req, res) => {
        const id = req.params.id;
        EventModel.deleteEvent(id, (error, result) => {
            if (error) {
                console.error('Error deleting event:', error);
                res.status(500).send('Internal Server Error');
                return;
            }
            res.json({ message: 'Event deleted successfully' });
        });
    }
};

module.exports = eventController;
