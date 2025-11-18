import { Button } from "@/components/ui/button";
import { Card } from "@/components/ui/card";
import { Info } from "lucide-react";
import { Candidate } from "@/pages/Voting";

interface CandidateCardProps {
  candidate: Candidate;
  onVote: (candidate: Candidate) => void;
  onDetail: (candidate: Candidate) => void;
  disabled: boolean;
  index: number;
}

const CandidateCard = ({ candidate, onVote, onDetail, disabled, index }: CandidateCardProps) => {
  return (
    <Card 
      className="overflow-hidden rounded-[20px] shadow-card hover:shadow-soft transition-all duration-300 hover:scale-[1.02] animate-fade-in bg-card"
      style={{ animationDelay: `${index * 100}ms` }}
    >
      <div className="relative">
        <div className="absolute top-4 left-4 z-10">
          <div className="w-12 h-12 rounded-full gradient-primary flex items-center justify-center">
            <span className="text-2xl font-bold text-primary-foreground">
              {candidate.number}
            </span>
          </div>
        </div>
        <img
          src={candidate.photo}
          alt={`${candidate.president} & ${candidate.vicePresident}`}
          className="w-full h-64 object-cover"
        />
      </div>
      
      <div className="p-6 space-y-4">
        <div>
          <h3 className="text-xl font-bold text-foreground">
            {candidate.president}
          </h3>
          <p className="text-muted-foreground">
            & {candidate.vicePresident}
          </p>
        </div>
        
        <p className="text-sm text-foreground line-clamp-2">
          {candidate.shortVision}
        </p>
        
        <div className="flex gap-2">
          <Button
            variant="outline"
            className="flex-1 rounded-xl"
            onClick={() => onDetail(candidate)}
          >
            <Info className="w-4 h-4 mr-2" />
            Detail
          </Button>
          <Button
            className="flex-1 rounded-xl gradient-primary hover:opacity-90"
            onClick={() => onVote(candidate)}
            disabled={disabled}
          >
            Pilih
          </Button>
        </div>
      </div>
    </Card>
  );
};

export default CandidateCard;
