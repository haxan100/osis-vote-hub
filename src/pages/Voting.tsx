import { useState, useEffect } from "react";
import { useNavigate } from "react-router-dom";
import { Button } from "@/components/ui/button";
import { Badge } from "@/components/ui/badge";
import { useToast } from "@/hooks/use-toast";
import CandidateCard from "@/components/CandidateCard";
import VoteConfirmDialog from "@/components/VoteConfirmDialog";
import VisionMissionModal from "@/components/VisionMissionModal";
import ThankYouCard from "@/components/ThankYouCard";
import { LogOut } from "lucide-react";

export interface Candidate {
  id: number;
  number: number;
  president: string;
  vicePresident: string;
  photo: string;
  shortVision: string;
  fullVision: string;
  fullMission: string;
}

const Voting = () => {
  const [userName, setUserName] = useState("");
  const [hasVoted, setHasVoted] = useState(false);
  const [selectedCandidate, setSelectedCandidate] = useState<Candidate | null>(null);
  const [showConfirmDialog, setShowConfirmDialog] = useState(false);
  const [showVisionModal, setShowVisionModal] = useState(false);
  const [candidateForDetail, setCandidateForDetail] = useState<Candidate | null>(null);
  const navigate = useNavigate();
  const { toast } = useToast();

  const candidates: Candidate[] = [
    {
      id: 1,
      number: 1,
      president: "Ahmad Rizki",
      vicePresident: "Putri Maharani",
      photo: "https://images.unsplash.com/photo-1539571696357-5a69c17a67c6?w=400&h=400&fit=crop",
      shortVision: "Membangun OSIS yang inovatif dan inklusif untuk seluruh siswa",
      fullVision: "Mewujudkan OSIS yang inovatif, inklusif, dan memberdayakan seluruh siswa dalam mengembangkan potensi diri melalui berbagai program kreatif dan edukatif.",
      fullMission: "1. Mengadakan workshop pengembangan skill setiap bulan\n2. Membuat platform komunikasi digital untuk siswa\n3. Menyelenggarakan festival budaya dan olahraga\n4. Memperkuat program mentoring antar siswa"
    },
    {
      id: 2,
      number: 2,
      president: "Siti Aisyah",
      vicePresident: "Budi Prasetyo",
      photo: "https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=400&h=400&fit=crop",
      shortVision: "OSIS yang peduli lingkungan dan meningkatkan prestasi sekolah",
      fullVision: "Membangun OSIS yang berfokus pada kelestarian lingkungan dan peningkatan prestasi akademik serta non-akademik melalui program berkelanjutan.",
      fullMission: "1. Kampanye green school dan pengelolaan sampah\n2. Program bimbingan belajar gratis\n3. Kompetisi talenta tingkat sekolah\n4. Kerjasama dengan alumni untuk mentoring"
    },
    {
      id: 3,
      number: 3,
      president: "Muhammad Farhan",
      vicePresident: "Diana Kusuma",
      photo: "https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=400&fit=crop",
      shortVision: "Digitalisasi OSIS dan penguatan kegiatan ekstrakurikuler",
      fullVision: "Mengintegrasikan teknologi dalam kegiatan OSIS dan memperkuat ekosistem ekstrakurikuler untuk mengoptimalkan bakat dan minat siswa.",
      fullMission: "1. Aplikasi OSIS untuk informasi dan absensi\n2. Live streaming acara sekolah\n3. Revitalisasi semua ekstrakurikuler\n4. E-sports dan robotik competition"
    }
  ];

  useEffect(() => {
    const storedName = localStorage.getItem("userName");
    const storedUserId = localStorage.getItem("userId");
    const storedVote = localStorage.getItem(`vote_${storedUserId}`);
    
    if (!storedName || !storedUserId) {
      navigate("/");
      return;
    }
    
    setUserName(storedName);
    
    if (storedVote) {
      setHasVoted(true);
      const votedCandidate = candidates.find(c => c.id === parseInt(storedVote));
      setSelectedCandidate(votedCandidate || null);
    }
  }, [navigate]);

  const handleVoteClick = (candidate: Candidate) => {
    setSelectedCandidate(candidate);
    setShowConfirmDialog(true);
  };

  const handleConfirmVote = () => {
    if (selectedCandidate) {
      const userId = localStorage.getItem("userId");
      localStorage.setItem(`vote_${userId}`, selectedCandidate.id.toString());
      setHasVoted(true);
      setShowConfirmDialog(false);
      
      toast({
        title: "Terima kasih!",
        description: "Suara Anda telah berhasil disimpan.",
      });
    }
  };

  const handleDetailClick = (candidate: Candidate) => {
    setCandidateForDetail(candidate);
    setShowVisionModal(true);
  };

  const handleLogout = () => {
    localStorage.removeItem("userId");
    localStorage.removeItem("userName");
    navigate("/");
  };

  return (
    <div className="min-h-screen bg-muted">
      <header className="sticky top-0 z-10 bg-card shadow-card border-b border-border">
        <div className="container mx-auto px-4 py-4 flex justify-between items-center">
          <div>
            <h1 className="text-xl md:text-2xl font-bold text-foreground">
              Halo, {userName}
            </h1>
            <div className="flex items-center gap-2 mt-1">
              <span className="text-sm text-muted-foreground">Status:</span>
              <Badge 
                variant={hasVoted ? "default" : "destructive"}
                className={hasVoted ? "bg-success" : ""}
              >
                {hasVoted ? "Sudah Memilih" : "Belum Memilih"}
              </Badge>
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
      </header>

      <main className="container mx-auto px-4 py-8">
        {hasVoted && selectedCandidate ? (
          <ThankYouCard candidate={selectedCandidate} />
        ) : (
          <>
            <div className="text-center mb-8 animate-fade-in">
              <h2 className="text-2xl md:text-3xl font-bold text-foreground mb-2">
                Pilih Calon Ketua & Wakil OSIS
              </h2>
              <p className="text-muted-foreground">
                Klik "Detail" untuk melihat visi misi lengkap, lalu klik "Pilih" untuk memberikan suara
              </p>
            </div>

            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
              {candidates.map((candidate, index) => (
                <CandidateCard
                  key={candidate.id}
                  candidate={candidate}
                  onVote={handleVoteClick}
                  onDetail={handleDetailClick}
                  disabled={hasVoted}
                  index={index}
                />
              ))}
            </div>
          </>
        )}
      </main>

      <VoteConfirmDialog
        open={showConfirmDialog}
        onOpenChange={setShowConfirmDialog}
        candidate={selectedCandidate}
        onConfirm={handleConfirmVote}
      />

      <VisionMissionModal
        open={showVisionModal}
        onOpenChange={setShowVisionModal}
        candidate={candidateForDetail}
      />
    </div>
  );
};

export default Voting;
