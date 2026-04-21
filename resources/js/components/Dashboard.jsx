import React from 'react';
import Sidebar from './Sidebar';
import Header from './Header';
import StatsCard from './StatsCard';
import ActivityTable from './ActivityTable';
import TrendChart from './TrendChart';

const Dashboard = () => {
  return (
    <div className="flex h-screen bg-[#0D1117] text-[#F0F6FC]">
      <Sidebar />
      <div className="flex-1 flex flex-col overflow-auto">
        <Header />
        <main className="p-6 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
          {/* Statistik */}
          <StatsCard title="Pengunjung" value="1,234" />
          <StatsCard title="Berita" value="56" />
          <StatsCard title="Video" value="12" />
          {/* Tabel Aktivitas */}
          <ActivityTable />
          {/* Grafik Tren */}
          <TrendChart />
        </main>
      </div>
    </div>
  );
};

export default Dashboard;
