// TopGpuView - displays GPU details on Homepage
function TopGpuView({ gpu, index, handleGpuSelection }) {
    return (
        <div className="bg-neutral-100 rounded-lg mb-8 py-8 flex flex-wrap md:flex-row">
            <div
                className={`order-2 px-12 md:basis-1/2 ${
                    index % 2 === 1 ? "md:order-1 md:text-right" : ""
                }`}
            >
                <p className="mb-4 text-3xl leading-8 font-light text-neutral-900">
                    {gpu.name}
                </p>
                <p className="mb-4 text-xl leading-7 font-light text-neutral-900 mb-4">
                    {`Base Clock: ${gpu.base_clock} MHz | Boost Clock: ${gpu.boost_clock} MHz | VRAM: ${gpu.vram} GB`}
                </p>
                <p className="mb-4 text-lg leading-7 font-light text-neutral-900">
                    Generation: {gpu.generation.name}
                </p>
                <button
                    onClick={() => handleGpuSelection(gpu.id)}
                    className="bg-blue-500 text-white px-4 py-2 rounded-md"
                >
                    Select GPU
                </button>
            </div>
            <div
                className={`order-1 md:basis-1/2 ${index % 2 === 1 ? "md:order-2" : ""}`}
            >
                {gpu.image && (
                    <img
                        src={`path/to/images/${gpu.image}`}
                        alt={gpu.name}
                        className="p-1 rounded-md border border-neutral-200 w-2/4 aspect-auto mx-auto"
                    />
                )}
            </div>
        </div>
    );
}
