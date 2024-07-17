import "../../App.css";
import  { useState } from 'react';
import ModalEventJpo from "../../components/layout-admin/ModalAddEvent";
import ListOfJpo from "../../components/layout-admin/ListOfJpo";
function EventJpo() {
  const [isModalOpen, setIsModalOpen] = useState(false);

  const openModal = () => {
    setIsModalOpen(true);
  };

  const closeModal = () => {
    setIsModalOpen(false);
  };

  return (
    <div>
      <h2 className="title-event">Créer un Event Jpo:</h2>
      <button className="add-jpo" onClick={openModal}>Ajouter Event</button>

      <ModalEventJpo isOpen={isModalOpen} onClose={closeModal}>
        <h3>Ajouter un nouvel Event JPO</h3>
        <form>
          <div>
            <label>Nom de l&apos;événement:</label>
            <input type="text" />
          </div>
          <div>
            <label>Date de l&apos;événement:</label>
            <input type="date" />
          </div>
          <div>
            <label>Lieu de l&apos;événement:</label>
            <input type="text" />
          </div>
          <div>
            <label>Description:</label>
            <textarea />
          </div>
          <div>
            <label>Nombres de places:</label>
            <input type="number" />
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
