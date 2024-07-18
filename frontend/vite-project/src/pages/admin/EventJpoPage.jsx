import "../../App.css";
import { useState } from 'react';
import ModalEventJpo from "../../components/layout-admin/ModalAddEvent";
import ListOfJpo from "../../components/layout-admin/ListOfJpo";

function EventJpo() {
  const [isModalOpen, setIsModalOpen] = useState(false);
  const [formData, setFormData] = useState({
    title: "",
    date: "",
    description: "",
    location: "",
    capacity: ""
  });

  const openModal = () => {
    setIsModalOpen(true);
  };

  const closeModal = () => {
    setIsModalOpen(false);
  };

  const handleChange = (e) => {
    const { name, value } = e.target;
    setFormData(prevFormData => ({
      ...prevFormData, 
      [name]: value 
    }));
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    console.log("Submitting form with data:", formData);

    try {
      const response = await fetch('http://localhost/JPO-Connect/backend/routes.php/jpo/create', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(formData)
      });

      if (response.ok) {
        const result = await response.json();
        console.log("Événement créé avec succès:", result);
        // Ajoutez ici la logique pour mettre à jour l'interface utilisateur après la création réussie de l'événement
        closeModal();
      } else {
        console.error("Erreur lors de la création de l'événement:", response.statusText);
      }
    } catch (error) {
      console.error("Erreur de réseau:", error);
    }
  };

  return (
    <div>
      <h2 className="title-event">Créer un Event Jpo:</h2>
      <button className="add-jpo" onClick={openModal}>Ajouter Event</button>

      <ModalEventJpo isOpen={isModalOpen} onClose={closeModal}>
        <h3>Ajouter un nouvel Event JPO</h3>
        <form onSubmit={handleSubmit}>
          <div>
            <label>Nom de l&apos;événement:</label>
            <input 
              type="text" 
              name="title" 
              value={formData.title} 
              onChange={handleChange} 
              required 
            />
          </div>
          <div>
            <label>Date de l&apos;événement:</label>
            <input 
              type="date" 
              name="date" 
              value={formData.date} 
              onChange={handleChange} 
              required 
            />
          </div>
          <div>
            <label>Description:</label>
            <textarea 
              name="description" 
              value={formData.description} 
              onChange={handleChange} 
              required 
            />
          </div>
          <div>
            <label>Lieu de l&apos;événement:</label>
            <input 
              type="text" 
              name="location" 
              value={formData.location} 
              onChange={handleChange} 
              required 
            />
          </div>
          <div>
            <label>Nombres de places:</label>
            <input 
              type="number" 
              name="capacity" 
              value={formData.capacity} 
              onChange={handleChange} 
              required 
            />
          </div>
          <button type="submit">Ajouter l&apos;event</button>
        </form>
      </ModalEventJpo>
      <div>
        <ListOfJpo/>
      </div>
    </div>
  );
}

export default EventJpo;
