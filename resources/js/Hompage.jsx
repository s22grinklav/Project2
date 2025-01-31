// Homepage - loads data from mock API and displays top GPUs
function Homepage({ handleGpuSelection }) {
    return (
        <section>
            <h2>Top GPUs:</h2>
            {topGpus.map((gpu, index) => (
                <TopGpuView
                    gpu={gpu}
                    key={gpu.id}
                    index={index}
                    handleGpuSelection={handleGpuSelection}
                />
            ))}
        </section>
    );
}
