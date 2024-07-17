// src/components/layout/Header.jsx
import {
  SignedIn,
  SignedOut,
  SignInButton,
  UserButton,
  useUser,
} from "@clerk/clerk-react";
import { useEffect } from "react";
import "./Header.css"; // Assurez-vous d'importer votre fichier CSS pour le style

export const Header = () => {
  const { isSignedIn, user } = useUser();

  useEffect(() => {
    console.log(user);
  }, [isSignedIn, user]);

  return (
    <header className="header">
      <div className="header-left">
        <img src="../../src/assets/logo-laplateforme-header.png" alt="Logo" className="logo" />
        <nav className="nav-links">
          <a  className="title-event" href="/link1"> Accueil</a>
          <a className="title-event" href="/link2">JPO</a>
        </nav>
      </div>
      
      <div className="header-right">
      <div className="searchBar">
    
<img  src="../../src/assets/icons8-search-30.png" alt="searchIcon" />
        <input type="text"  className="search-bar" />
      </div>
        <SignedOut>
          <SignInButton />
        </SignedOut>
        <SignedIn>
          <UserButton />
        </SignedIn>
      </div>
    </header>
  );
};
