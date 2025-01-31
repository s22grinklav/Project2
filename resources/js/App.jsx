import React, { useState } from "react";

// Header component
function Header() {
    return (
        <header className="bg-green-500 mb-8 py-2 sticky top-0">
            <div className="px-2 py-2 font-serif text-green-50 text-xl leading-6 md:container md:mx-auto">
                GPU Website
            </div>
        </header>
    );
}

// Footer component
function Footer() {
    return (
        <footer className="bg-neutral-300 mt-8">
            <div className="py-8 md:container md:mx-auto px-2">
                K. Grinvalds, VeA, 2025
            </div>
        </footer>
    );
}

// Go Back Button
function GoBackBtn({ handleGoingBack }) {
    return (
        <button
            className="inline-block rounded-full py-2 px-4 bg-neutral-500 hover:bg-neutral-400 text-neutral-50 cursor-pointer"
            onClick={handleGoingBack}
        >
            Back
        </button>
    );
}

// See More Button
function SeeMoreBtn({ gpuID, handleGpuSelection }) {
    return (
        <button
            className="inline-block rounded-full py-2 px-4 bg-sky-500 hover:bg-sky-400 text-sky-50 cursor-pointer"
            onClick={() => handleGpuSelection(gpuID)}
        >
            See more
        </button>
    );
}

// Selected GPU View - displays details of the selected GPU
function SelectedGpuView({ selectedGpuID, handleGoingBack }) {
    const selectedGpu = {
        id: selectedGpuID,
        name: "RTX 3080",
        base_clock: 1670,
        boost_clock: 1710,
        cuda_cores: 10240,
        memory_type: "GDDR6X",
        vram: 10,
        generation: { id: 3, name: "Geforce 30 Series" },
        image: "path/to/rtx3080_image.jpg"  // Add correct path to the image
    };

    return (
        <>
            <div className="rounded-lg flex flex-wrap md:flex-row">
                <div className="order-2 md:order-1 md:pt-12 md:basis-1/2">
                    <h1 className="text-3xl leading-8 font-light text-neutral-900 mb-2">
                        {selectedGpu.name}
                    </h1>
                    <p className="text-xl leading-7 font-light text-neutral-900 mb-2">
                        VRAM: {selectedGpu.vram} GB
                    </p>
                    <p className="text-xl leading-7 font-light text-neutral-900 mb-4">
                        Base Clock: {selectedGpu.base_clock} MHz | Boost Clock: {selectedGpu.boost_clock} MHz
                    </p>
                    <dl className="mb-4 md:flex md:flex-wrap md:flex-row">
                        <dt className="font-bold md:basis-1/4">Generation</dt>
                        <dd className="mb-2 md:basis-3/4">{selectedGpu.generation.name}</dd>
                    </dl>
                </div>
                <div className="order-1 md:order-2 md:pt-12 md:px-12 md:basis-1/2">
                    <img
                        src={selectedGpu.image}
                        alt={selectedGpu.name}
                        className="p-1 rounded-md border border-neutral-200 mx-auto"
                    />
                </div>
            </div>
            <div className="mb-12 flex flex-wrap">
                <GoBackBtn handleGoingBack={handleGoingBack} />
            </div>
        </>
    );
}

// Related GPU Section
function RelatedGpuSection({ selectedGpuID, handleGpuSelection }) {
    const allGpus = [
        { id: 2, name: "RTX 2080", image: "path/to/rtx2080.jpg" },
        { id: 4, name: "RTX 2080 Ti", image: "path/to/rtx2080ti.jpg" },
        { id: 5, name: "RTX 3080", image: "path/to/rtx3080.jpg" },  // Same as selected GPU to demonstrate filtering
    ];

    // Filter out the currently selected GPU
    const relatedGpus = allGpus.filter(gpu => gpu.id !== selectedGpuID);

    return (
        <>
            <div className="flex flex-wrap">
                <h2 className="text-3xl leading-8 font-light text-neutral-900 mb-4">
                    Similar GPUs
                </h2>
            </div>
            <div className="flex flex-wrap md:flex-row md:space-x-4 md:flex-nowrap">
                {relatedGpus.map((gpu) => (
                    <RelatedGpuView
                        gpu={gpu}
                        key={gpu.id}
                        handleGpuSelection={handleGpuSelection}
                    />
                ))}
            </div>
        </>
    );
}

// Related GPU View
function RelatedGpuView({ gpu, handleGpuSelection }) {
    return (
        <div className="rounded-lg mb-4 md:basis-1/3">
            <img
                src={gpu.image}
                alt={gpu.name}
                className="md:h-[400px] md:mx-auto max-md:w-2/4 max-md:mx-auto"
            />
            <div className="p-4">
                <h3 className="text-xl leading-7 font-light text-neutral-900 mb-4">
                    {gpu.name}
                </h3>
                <SeeMoreBtn
                    gpuID={gpu.id}
                    handleGpuSelection={handleGpuSelection}
                />
            </div>
        </div>
    );
}

// Homepage component
function Homepage({ handleGpuSelection }) {
    const allGpus = [
        { id: 1, name: "RTX 3060", image: "path/to/rtx3060.jpg" },
        { id: 2, name: "RTX 2080", image: "path/to/rtx2080.jpg" },
        { id: 3, name: "RTX 3080", image: "path/to/rtx3080.jpg" },
        { id: 4, name: "RTX 2080 Ti", image: "path/to/rtx2080ti.jpg" },
    ];

    return (
        <div className="flex flex-wrap">
            {allGpus.map((gpu) => (
                <RelatedGpuView
                    gpu={gpu}
                    key={gpu.id}
                    handleGpuSelection={handleGpuSelection}
                />
            ))}
        </div>
    );
}

// Main application component
export default function App() {
    // Declare the state for selected GPU ID
    const [selectedGpuID, setSelectedGpuID] = useState(null);

    // Handler to set selected GPU ID
    function handleGpuSelection(gpuID) {
        setSelectedGpuID(gpuID);
    }

    // Handler to clear GPU ID (go back to homepage)
    function handleGoingBack() {
        setSelectedGpuID(null);
    }

    return (
        <>
            <Header />
            <main className="mb-8 px-2 md:container md:mx-auto">
                {
                    selectedGpuID
                        ? <SelectedGpuView
                            selectedGpuID={selectedGpuID}
                            handleGoingBack={handleGoingBack}
                        />
                        : <Homepage handleGpuSelection={handleGpuSelection} />
                }
            </main>
            <Footer />
        </>
    );
}
