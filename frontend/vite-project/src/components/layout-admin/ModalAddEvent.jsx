import * as React from 'react';
import Button from '@mui/material/Button';
import Modal from '@mui/material/Modal';


export default function ModalEventJpo() {
  const [open, setOpen] = React.useState(false);
  const handleOpen = () => setOpen(true);
  const handleClose = () => setOpen(false);

  return (
    <div>
      <Button onClick={handleOpen}>Ajouter un Event</Button>
      <Modal
        open={open}
        onClose={handleClose}
        aria-labelledby="modal-modal-title"
        aria-describedby="modal-modal-description"
      >
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
            <label>Nombre de places:</label>
            <input type="number" />
          </div>
          <button type="submit">Ajouter l&apos;event</button>
        </form>
      </Modal>
    </div>
  );
}

