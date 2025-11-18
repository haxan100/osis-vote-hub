import { useState, useEffect } from "react";
import { useNavigate } from "react-router-dom";
import { Button } from "@/components/ui/button";
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from "@/components/ui/card";
import { Avatar, AvatarFallback, AvatarImage } from "@/components/ui/avatar";
import { Progress } from "@/components/ui/progress";
import { 
  LogOut, 
  TrendingUp, 
  Users, 
  BarChart3,
  Award,
  Clock
} from "lucide-react";
import { PieChart, Pie, Cell, ResponsiveContainer, Legend, Tooltip } from "recharts";

const CandidateDashboard = () => {
  const [candidateName, setCandidateName] = useState("");
  const [candidateNumber, setCandidateNumber] = useState("");
  const navigate = useNavigate();

  useEffect(() => {
    const storedName = localStorage.getItem("userName");
    const storedRole = localStorage.getItem("userRole");
    const storedNumber = localStorage.getItem("candidateNumber");
    
    if (!storedName || storedRole !== "calon") {
      navigate("/");
      return;
    }
    
    setCandidateName(storedName);
    setCandidateNumber(storedNumber || "");
  }, [navigate]);

  const handleLogout = () => {
    localStorage.removeItem("userId");
    localStorage.removeItem("userName");
    localStorage.removeItem("userRole");
    localStorage.removeItem("candidateNumber");
    navigate("/");
  };

  // Dummy data based on candidate number
  const getCandidateData = () => {
    const dataMap: { [key: string]: any } = {
      "1": { votes: 45, percentage: 45, color: "hsl(var(--primary))" },
      "2": { votes: 32, percentage: 32, color: "hsl(var(--secondary))" },
      "3": { votes: 23, percentage: 23, color: "hsl(var(--accent))" },
    };
    return dataMap[candidateNumber] || dataMap["1"];
  };

  const candidateData = getCandidateData();

  const chartData = [
    { name: "Suara Anda", value: candidateData.votes, fill: candidateData.color },
    { name: "Lainnya", value: 100 - candidateData.votes, fill: "hsl(var(--muted))" },
  ];

  const stats = [
    {
      label: "Total Suara",
      value: candidateData.votes.toString(),
      icon: Award,
      color: "text-primary",
      description: "Suara yang diperoleh",
    },
    {
      label: "Persentase",
      value: `${candidateData.percentage}%`,
      icon: TrendingUp,
      color: "text-secondary",
      description: "Dari total pemilih",
    },
    {
      label: "Total Pemilih",
      value: "100",
      icon: Users,
      color: "text-accent",
      description: "Yang sudah memilih",
    },
    {
      label: "Partisipasi",
      value: "66.7%",
      icon: BarChart3,
      color: "text-success",
      description: "Tingkat partisipasi",
    },
  ];

  const candidatePhotos: { [key: string]: string } = {
    "1": "https://images.unsplash.com/photo-1539571696357-5a69c17a67c6?w=400&h=400&fit=crop",
    "2": "https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=400&h=400&fit=crop",
    "3": "https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=400&fit=crop",
  };

  return (
    <div className="min-h-screen bg-muted">
      {/* Header */}
      <header className="sticky top-0 z-10 bg-card shadow-card border-b border-border">
        <div className="container mx-auto px-4 py-4">
          <div className="flex justify-between items-center">
            <div className="flex items-center gap-3">
              <Avatar className="w-12 h-12 border-2 border-primary">
                <AvatarImage src={candidatePhotos[candidateNumber]} />
                <AvatarFallback className="gradient-primary text-primary-foreground font-bold">
                  {candidateNumber}
                </AvatarFallback>
              </Avatar>
              <div>
                <h1 className="text-xl md:text-2xl font-bold text-foreground">
                  {candidateName}
                </h1>
                <p className="text-sm text-muted-foreground">
                  Pasangan Calon Nomor {candidateNumber}
                </p>
              </div>
            </div>
            <Button
              variant="outline"
              size="sm"
              onClick={handleLogout}
              className="rounded-xl"
            >
              <LogOut className="w-4 h-4 mr-2" />
              Keluar
            </Button>
          </div>
        </div>
      </header>

      <main className="container mx-auto px-4 py-8">
        {/* Welcome Card */}
        <Card className="rounded-[20px] shadow-card mb-8 gradient-card animate-fade-in">
          <CardContent className="p-6 md:p-8">
            <div className="flex flex-col md:flex-row items-center gap-6">
              <Avatar className="w-24 h-24 border-4 border-primary shadow-soft">
                <AvatarImage src={candidatePhotos[candidateNumber]} />
                <AvatarFallback className="gradient-primary text-primary-foreground text-3xl font-bold">
                  {candidateNumber}
                </AvatarFallback>
              </Avatar>
              <div className="text-center md:text-left flex-1">
                <h2 className="text-2xl md:text-3xl font-bold text-foreground mb-2">
                  Selamat Datang, {candidateName.split(" ")[0]}!
                </h2>
                <p className="text-muted-foreground mb-4">
                  Berikut adalah statistik perolehan suara Anda saat ini
                </p>
                <div className="flex items-center justify-center md:justify-start gap-2 text-sm text-muted-foreground">
                  <Clock className="w-4 h-4" />
                  <span>Data diperbarui secara real-time</span>
                </div>
              </div>
            </div>
          </CardContent>
        </Card>

        {/* Stats Grid */}
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
          {stats.map((stat, index) => (
            <Card key={index} className="rounded-[20px] shadow-card animate-slide-up">
              <CardContent className="p-6">
                <div className="flex items-start justify-between mb-4">
                  <div className={`w-12 h-12 rounded-full bg-muted flex items-center justify-center ${stat.color}`}>
                    <stat.icon className="w-6 h-6" />
                  </div>
                </div>
                <h3 className="text-3xl font-bold text-foreground mb-1">{stat.value}</h3>
                <p className="text-sm font-medium text-foreground">{stat.label}</p>
                <p className="text-xs text-muted-foreground mt-1">{stat.description}</p>
              </CardContent>
            </Card>
          ))}
        </div>

        {/* Charts Section */}
        <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
          {/* Pie Chart */}
          <Card className="rounded-[20px] shadow-card">
            <CardHeader>
              <CardTitle>Perolehan Suara Anda</CardTitle>
              <CardDescription>
                Distribusi suara Anda dari total suara yang masuk
              </CardDescription>
            </CardHeader>
            <CardContent className="h-80">
              <ResponsiveContainer width="100%" height="100%">
                <PieChart>
                  <Pie
                    data={chartData}
                    cx="50%"
                    cy="50%"
                    labelLine={false}
                    label={({ name, percent }) => `${name}: ${(percent * 100).toFixed(1)}%`}
                    outerRadius={100}
                    fill="#8884d8"
                    dataKey="value"
                  >
                    {chartData.map((entry, index) => (
                      <Cell key={`cell-${index}`} fill={entry.fill} />
                    ))}
                  </Pie>
                  <Tooltip />
                  <Legend />
                </PieChart>
              </ResponsiveContainer>
            </CardContent>
          </Card>

          {/* Progress Card */}
          <Card className="rounded-[20px] shadow-card">
            <CardHeader>
              <CardTitle>Target & Pencapaian</CardTitle>
              <CardDescription>
                Progress perolehan suara terhadap target
              </CardDescription>
            </CardHeader>
            <CardContent className="space-y-6">
              <div>
                <div className="flex justify-between mb-2">
                  <span className="text-sm font-medium text-foreground">
                    Perolehan Suara
                  </span>
                  <span className="text-sm font-bold text-primary">
                    {candidateData.votes} / 100
                  </span>
                </div>
                <Progress value={candidateData.percentage} className="h-3" />
                <p className="text-xs text-muted-foreground mt-2">
                  {candidateData.percentage}% dari total suara
                </p>
              </div>

              <div className="space-y-4 pt-4 border-t border-border">
                <div className="flex items-center justify-between p-4 bg-muted rounded-xl">
                  <div>
                    <p className="text-sm font-medium text-foreground">Posisi Saat Ini</p>
                    <p className="text-xs text-muted-foreground">Ranking perolehan suara</p>
                  </div>
                  <div className="text-2xl font-bold text-primary">
                    #{candidateNumber === "1" ? "1" : candidateNumber === "2" ? "2" : "3"}
                  </div>
                </div>

                <div className="flex items-center justify-between p-4 bg-muted rounded-xl">
                  <div>
                    <p className="text-sm font-medium text-foreground">Status Pemilihan</p>
                    <p className="text-xs text-muted-foreground">Waktu tersisa</p>
                  </div>
                  <div className="text-sm font-bold text-secondary">
                    Sedang Berlangsung
                  </div>
                </div>
              </div>
            </CardContent>
          </Card>
        </div>

        {/* Additional Info */}
        <Card className="rounded-[20px] shadow-card mt-6">
          <CardHeader>
            <CardTitle>Informasi Penting</CardTitle>
          </CardHeader>
          <CardContent>
            <div className="space-y-3">
              <div className="p-4 bg-primary/10 border border-primary/20 rounded-xl">
                <p className="text-sm text-foreground">
                  <strong>Catatan:</strong> Data yang ditampilkan adalah perolehan suara Anda saja. 
                  Anda tidak dapat melihat detail suara kandidat lain untuk menjaga keadilan dan transparansi.
                </p>
              </div>
              <div className="p-4 bg-muted rounded-xl">
                <p className="text-sm text-muted-foreground">
                  Hasil resmi akan diumumkan setelah periode pemilihan berakhir. 
                  Tetap semangat dan terima kasih atas partisipasi Anda!
                </p>
              </div>
            </div>
          </CardContent>
        </Card>
      </main>
    </div>
  );
};

export default CandidateDashboard;
