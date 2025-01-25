import React from 'react';
import { createRoot } from 'react-dom/client';
import '../css/app.css';

function App() {
    return (
        <div className="min-h-screen bg-gray-100">
            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900">
                            Welcome to Kornati Tours
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}

const container = document.getElementById('app');
const root = createRoot(container);
root.render(<App />); 