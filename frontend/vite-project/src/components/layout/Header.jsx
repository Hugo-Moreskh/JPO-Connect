import {
  SignedIn,
  SignedOut,
  SignInButton,
  UserButton,
  useUser,
} from "@clerk/clerk-react";
import { useEffect } from "react";

export const Header = () => {
  const { isSignedIn, user } = useUser();

  useEffect(() => {
    console.log(user);
  }, [isSignedIn]);
  // user email = user.primaryEmailAddress.emailAddress
  //role: Directeur : tous les droits (ajouter des droits, supprimer des droits, modifier les droits, modifier les événements, supprimer les événements, modifier les utilisateurs)
  //role: Responsable : tous les droits sauf ajouter des droits (ajouter des droits, supprimer des droits, modifier les droits, modifier les événements, supprimer les événements, modifier les utilisateurs)
  //role: Salarié : modifier les événements
  return (
    <header>
      <SignedOut>
        <SignInButton />
      </SignedOut>
      <SignedIn>
        <UserButton />
        {isSignedIn && (
          <p>Signed in as: {user.primaryEmailAddress.emailAddress}</p>
        )}
      </SignedIn>
    </header>
  );
};
