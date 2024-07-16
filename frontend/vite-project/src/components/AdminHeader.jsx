import logoLeft from "../assets/Logo-laplateforme.png"; // Chemin vers votre logo gauche
import logoRight from "../assets/image-laplateforme.png"; // Chemin vers votre logo droit

function Header() {
  return (
    <header className="header">
      <div className="header-left">
        <img src={logoLeft} alt="Logo Left" className="logo" />
      </div>
      <div className="header-center">
        <h1 className="title">DashBoard Admin</h1>
      </div>
      <div className="header-right">
        <img src={logoRight} alt="Logo Right" className="logo" />
      </div>
    </header>
  );
}

export default Header;
