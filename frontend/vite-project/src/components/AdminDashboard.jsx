import { Sidebar, Menu, MenuItem } from "react-pro-sidebar";
import GridViewRoundedIcon from "@mui/icons-material/GridViewRounded";
import EventIcon from "@mui/icons-material/Event";
import AdminPanelSettingsIcon from "@mui/icons-material/AdminPanelSettings";
import ContentPasteIcon from "@mui/icons-material/ContentPaste";
import LogoutRoundedIcon from "@mui/icons-material/LogoutRounded";
import { useNavigate } from "react-router-dom";

function AdminDashBoard() {
  const navigate = useNavigate();
  return (
    <div style={{ display: "flex", height: "70vh" }}>
      <Sidebar className="app">
        <Menu className="menu-container">
          <div className="menu-top">
            <MenuItem icon={<GridViewRoundedIcon />} className="menu1">
              <h3 className="title">DashBoard</h3>
            </MenuItem>
            <MenuItem
              icon={<EventIcon />}
              className="navlink"
              onClick={() => navigate("/event-jpo")}
            >
              Event JPO
            </MenuItem>
            <MenuItem icon={<AdminPanelSettingsIcon />} className="navlink">
              {" "}
              Rôle Admin{" "}
            </MenuItem>
            <MenuItem icon={<ContentPasteIcon />} className="navlink">
              {" "}
              Contenu du site{" "}
            </MenuItem>
          </div>
          <div className="menu-bottom">
            <MenuItem className="navlink" icon={<LogoutRoundedIcon />}>
              {" "}
              Se déconnecter{" "}
            </MenuItem>
          </div>
        </Menu>
      </Sidebar>
    </div>
  );
}

export default AdminDashBoard;
