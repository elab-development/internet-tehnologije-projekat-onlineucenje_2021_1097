import { BrowserRouter, Routes, Route } from 'react-router-dom';

import './App.css';
import Header from './components/Header/Header';
import Home from './pages/Home';
import About from './pages/About';
import Courses from './pages/Courses';
import Team from './pages/Team';
import Footer from './components/Footer/Footer';

function App() {
  return (
    <BrowserRouter>
      <Header />
      <Routes>
        <Route path='/' element={<Home />} />
        <Route path='/about' element={<About />} />
        <Route path='/courses' element={<Courses />} />
        <Route path='/team' element={<Team />} />
      </Routes>
      <Footer />
    </BrowserRouter>
  );
}

export default App;
